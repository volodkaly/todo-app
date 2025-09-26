<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        //dostavame hodnotu ze zobrazeni a dale na jeji zaklade zde filtrujeme ukoly
        $showWithStatus = $request->input('showWithStatus');
        $sort = $request->input('sort', 'title'); //ze zobrazeni dostavame signal pro razeni
        //nejsou-li zadne ukoly - promenna bude mit jen prazdne pole
        //ukoly radime dle nazvu nebo dle terminu
        Task::all() ? $tasks = Task::orderBy($sort)->get() : $tasks = [];
        if ($showWithStatus === 'completed') {
            Task::all() ? $tasks = Task::orderBy($sort)->where('completed', true)->get() : $tasks = [];
        } elseif ($showWithStatus === 'incompleted') {
            Task::all() ? $tasks = Task::orderBy($sort)->where('completed', false)->get() : $tasks = [];
        }
        return view('tasks.index', compact('tasks', 'showWithStatus'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'deadline' => [
                'required',
                'date',
                //jeden ze zpusobu validace data
                function ($attribute, $value, $fail) {
                    if ($value < now()->toDateString()) {
                        $fail('Nelze uložit úkol s minulým termínem. Zvolte prosím budoucí datum.');
                    }
                }
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $task->title = trim($request->input('title'));
        $task->content = trim($request->input('content'));
        $task->deadline = $request->input('deadline');
        $task->save();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => 'required',
            'deadline' => 'required|date',
        ]);


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'deadline' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if ($value < now()->toDateString()) {
                        $fail('Nelze uložit úkol s minulým termínem. Zvolte prosím budoucí datum.');
                    }
                }
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //nazev a popis orezavame, mazeme pripadne mezery na zacatku i na konci
        $task->title = trim($request->input('title'));
        $task->content = trim($request->input('content'));
        $task->deadline = $request->input('deadline');
        $task->save();

        return redirect()->route('tasks.index');



    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }


}

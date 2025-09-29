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
        $showWithStatus = $request->input('showWithStatus');
        $sort = $request->input('sort', 'title');

        $query = Task::query();

        if ($showWithStatus === 'completed') {
            $query->where('completed', true);
        } elseif ($showWithStatus === 'incompleted') {
            $query->where('completed', false);
        }
        $tasks = $query->get();
        $tasks = $tasks->sortBy(function ($task) use ($sort) {
            return mb_strtolower($task->{$sort});
        }, SORT_NATURAL)->values();

        return view('tasks.index', compact('tasks', 'showWithStatus'));
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' =>
                'required',
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

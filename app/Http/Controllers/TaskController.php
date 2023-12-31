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
        $sort = $request->input('sort', 'title');
        $tasks = Task::orderBy($sort)->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'deadline' => ['required', 'date', function ($attribute, $value, $fail) {
                if ($value < now()->toDateString()) {
                    $fail('Nelze uložit úkol s minulým termínem. Zvolte prosím budoucí datum.');
                }

                $tasksCount = Task::where('deadline', $value)->count();
                if ($tasksCount >= 2) {
                    $fail('Nelze mít více než 2 úkoly se stejným termínem. Zvolte jiný termín, prosím.');
                }
            }],
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
            'deadline' => ['required', 'date', function ($attribute, $value, $fail) {
                if ($value < now()->toDateString()) {
                    $fail('Nelze uložit úkol s minulým termínem. Zvolte prosím budoucí datum.');
                }

                $tasksCount = Task::where('deadline', $value)->count();
                if ($tasksCount >= 2) {
                    $fail('Nelze mít více než 2 úkoly se stejným termínem. Zvolte jiný termín, prosím.');
                }
            }],
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

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function update(Request $request, Task $task)
    {

        $task->completed = !$task->completed;


        $task->save();

        return redirect()->route('tasks.index');
    }
}

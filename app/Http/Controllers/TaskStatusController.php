<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'completed' => 'nullable|boolean',
        ]);

        $task->completed = $request->input('completed');
        $task->save();

        return redirect()->route('tasks.index', $task->id);
    }
}

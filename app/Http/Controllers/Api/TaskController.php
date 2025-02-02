<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class TaskController extends Controller
{
    public function index()

    {
        $tasks = Task::where("user_id", request()->user()->id)->get();

        return response()->json(
            [

                "tasks" => $tasks
            ]
        );
    }
    public function show(Task $task)
    {

        return response()->json(
            [
                "task" => $task
            ]
        );
    }
    public function destroy(Task $task)
    {
        // $task->delete();

        $task->delete();
        return response()->json([
            "message" => "Task deleted successfully"
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            "task" => "required",
            "status" => [Rule::in(["Pending", "Done"])],


        ]);

        $task = Task::create([
            "task" => $request->task,
            "status" => $request->status ?? "Pending",
            "user_id" => $request->user()->id
        ]);
        return response()->json([
            "message" => "Task created successfully",
            "task" => $task
        ]);
    }
    public function update(Request $request, Task $task)
    {
        $attr = $request->validate([
            "task" => "min:3",
            "status" => [Rule::in(["Pending", "Done"])],
        ]);

        $task->update($attr);
        return response()->json([
            "message" => "Task updated successfully",
            "task" => $task
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()

    {
        $tasks = Task::where("user_id", Auth::user()->id)->get();

        return view("welcome", ["tasks" => $tasks]);
    }
    public function edit(Task $task)
    {


        return view('edit', ["task" => $task]);
    }
    public function destroy(Task $task)
    {
        // $task->delete();
        Task::destroy($task->id);
        return redirect("/");
    }
    public function store(Request $request)
    {
        $request->validate([
            "task" => "required",
            "status" => [Rule::in(["Pending", "Done"])],


        ]);

        $task = Task::create([
            "task" => $request->task,
            "status" => $request->status,
            "user_id" => Auth::user()->id
        ]);
        return redirect("/");
    }
    public function update(Request $request, Task $task)
    {
        // dd($request->all());

        $updateTask = $request->validate([
            "task" => "required",
            "status" => "required"
        ]);



        $task->update($updateTask);
        
        return redirect("/");
    }
}

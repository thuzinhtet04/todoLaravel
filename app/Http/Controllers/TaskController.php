<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()

    {
        $tasks = Task::where("user_id", Auth::user()->id)->get();

        return view("welcome", ["tasks" => $tasks]);
    }
    public function edit(Task $task)
    {

        dd($task);
        return view('edit');
    }
    public function destroy(Task $task)
    {
        // $task->delete();
        Task::destroy($task->id);
        return redirect("/");
    }
}

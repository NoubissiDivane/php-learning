<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    public function showTasks(){ 
        $tasks = Task::all();

        return view('welcome', compact('tasks'));
    }

    public function addTask(Request $request){ 

        $validator = Validator::make($request->all(), [
            'task_type' => 'required|string|max:10',
            "task_name" => 'required|string|max:10',
            "task_description" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $task = new Task;

        if ($request->get('task_type') != ""){
            $task->task_type = $request->get('task_type');
        }

        if ($request->get('task_name') != ""){
            $task->task_name = $request->get('task_name');
        }

        if ($request->get('task_description') != ""){
            $task->task_description = $request->get('task_description');
        }

        $task->save();

        $tasks = Task::all();

        $message = "Tache ajoute avec succes";

        return redirect()->back()->with('message', $message);

        //return redirect(route("/"));

        //return view('welcome', compact('tasks'));
    }


}


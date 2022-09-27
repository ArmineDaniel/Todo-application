<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class ToDoController extends Controller
{
    public function index(Request $request)
    {
        $tasks = auth()->user()->tasks();
        if($request->search){
            if($request->completed_include){
                $tasks = $tasks->where('text', 'like', "$request->search%")->paginate(10)->withquerystring();
                return view('dashboard', compact('tasks'));
            }
            else{
                $tasks = $tasks->whereNull('completed_at')->where('text', 'like', "$request->search%")->paginate(10)->withquerystring();
                return view('dashboard', compact('tasks'));
            }
        }
        elseif ($request->due_date_time_filter){
            if($request->completed_filter){
                $tasks = $tasks->where('due_date_time', 'like', "$request->due_date_time_filter%")->paginate(10)->withquerystring();
                return view('dashboard', compact('tasks'));
            }
            else{
                $tasks = $tasks->whereNull('completed_at')->where('due_date_time', 'like', "$request->due_date_time_filter%")->paginate(10)->withquerystring();
                return view('dashboard', compact('tasks'));
            }
        }
        elseif ($request->completed_filter){
            $tasks = $tasks->whereNotNull('completed_at')->paginate(10)->withquerystring();
            return view('dashboard', compact('tasks'));
        }
        else {
            $tasks = $tasks->paginate(10);
            return view('dashboard', compact('tasks'));
        }
    }
    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'due_date_time' => 'required'
        ]);
        $task = new Task();
        $task->text = $request->text;
        $task->due_date_time = $request->due_date_time;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    public function edit(Task $task)
    {

        if (auth()->user()->id === $task->user_id)
        {
            return view('edit', compact('task'));
        }
        else {
            return redirect('/dashboard');
        }
    }
    public function delete(Task $task)
    {
        $task->delete();
        return redirect('/dashboard');
    }

    public function complete(Task $task)
    {
        date_default_timezone_set('Asia/Yerevan');
        $task->completed_at  = date("Y-m-d H:i:s");
        $task->save();
        return redirect('/dashboard');
    }
    public function update(Request $request, Task $task)
    {
            $this->validate($request, [
                'text' => 'required',
                'due_date_time' => 'required'
            ]);
            $task->text = $request->text;
            $task->due_date_time = $request->due_date_time;
            $task->completed_at = $request->completed_at;
            $task->save();
            return redirect('/dashboard');
    }
}

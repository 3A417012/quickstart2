<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request){
    	$tasks = Task::where('user_id', $request->user()->id)->get();

    	return view('tasks.index', [
        	'tasks' => $tasks,
    	]);

	}

	public function store(Request $request){
    	$this->validate($request, [
        	'name' => 'required|max:255',
    	]);

    	// Create The Task...
    	$request->user()->tasks()->create([
        	'name' => $request->name,
    	]);

    	return redirect('/tasks');
	}

    public function __construct(){
        $this->middleware('auth');
    }
}

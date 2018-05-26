<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	return view('todo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title'        => 'required|max:255',
    		'description' => 'required',
    		'todolist_id' => 'required',
    	]);

    	$todo = new Todo();
    	$todo->user_id = Auth::user()->id;
    	$todo->title = $request->title;
    	$todo->description = $request->description;
    	$todo->todolist_id = $request->todolist_id;
    	$save = $todo->save();

    	if ($save) {
    		return response()->json([
    			'status' => 'success',
    			'todo' => $todo
    		]);
    	} else {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Todo not save! Try again!'
    		]);
    	}
    }


    public function show($id)
    {
    	$todos = Todo::where('todolist_id',$id)->get();
    	return response()->json($todos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createTodo()
    {
    	return view('createTodos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$todo = Todo::findOrFail($id);
    	$todo->user_id = Auth::user()->id;
    	$todo->title = $request->title;
    	$todo->description = $request->description;
    	//$todo->todolist_id = $request->todolist_id;
    	$save = $todo->save();

    	if ($save) {
    		return response()->json([
    			'status' => 'success',
    			'todo' => $todo
    		])->redirect()->back();
    	} else {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Todo not save! Try again!'
    		]);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$todo = Todo::findOrFail($id);
    	$todo->delete();

    	return response()->json('Todo Successfully Deleted');
    }
}

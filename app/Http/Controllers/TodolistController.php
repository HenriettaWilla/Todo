<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todolist;
use Auth;


class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	return view('home');
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    	
    	$this->validate($request, [
    		'list_name'        => 'required|max:255',
    		
    	]);

    	$todolist = new Todolist;
    	$todolist->user_id = Auth::user()->id;
    	$todolist->list_name = $request->list_name;


    	if ($todolist->save()) {
    		return response()->json([
    			'status' => 'success',
    			'todolist' => $todolist
    		]);
    	} else {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Todolist not save! Try again!'
    		]);
    	}
    }



    public function show()
    {
    	$todolists = Todolist::where(['user_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();

    	return response()->json($todolists);


    }



    
    public function update(Request $request, $id)
    {
    	$todolist = Todolist::findOrFail($id);
    	
    	
    	$todolist->user_id = Auth::user()->id;
    	$todolist->list_name = $request->list_name;
    	$save = $todolist->save();


    	if ($save) {
    		return response()->json([
    			'status' => 'success',
    			'todolist' => $todolist
    		]);
    	} else {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Todolist not save! Try again!'
    		]);
    	}
    }




    public function destroy($id)
    {
    	$todolist = Todolist::findOrFail($id);
    	$todolist->delete();

    	//return response()->json('Successfully Deleted');
    	return response()->json([
    		'success' => 'Todolist deleted successfully!'
    	], 200);
    }
}

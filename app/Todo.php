<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	
	public function todolists(){
		return $this->belongsTo('App\Todolist');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}


}

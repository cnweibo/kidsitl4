<?php

class Mathexercisecat extends \Eloquent {
	protected $fillable = [];
	public $table = "mathexercisecats";
	public function exercises()
	{
		return $this->hasMany('Mathexercise');
	}
}
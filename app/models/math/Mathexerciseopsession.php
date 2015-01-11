<?php

class Mathexerciseopsession extends \Eloquent {
	protected $fillable = [];
	public  $timestamps = false;
	public function opdatas()
	{
		return $this->hasMany('Mathexerciseopdata');
	}
}
<?php

class Student extends \Eloquent {
	protected $fillable = [];
	public function belongingclass()
	{
		return $this->belongsTo('Classroom','classroom_id')->select('id','sysname');
	}
	public function mathscore()
	{
		return $this->hasMany('Mathscore');
	}
}
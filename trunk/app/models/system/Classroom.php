<?php

class Classroom extends \Eloquent {
	protected $fillable = [];
	public function owner()
	{
		return $this->belongsTo('Teacher','teacher_id');
	}
	public function students()
	{
		return $this->hasMany('Student');
	}
}
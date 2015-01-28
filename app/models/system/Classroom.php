<?php

class Classroom extends \Eloquent {
	protected $fillable = [];
	public function owner()
	{
		return $this->belongsTo('Teacher','teacher_id')->select(array('id', 'name','sysloginname'));
	}
	public function students()
	{
		return $this->hasMany('Student');
	}
}
<?php

class Teacher extends \Eloquent {
	protected $fillable = [];
	public $table = "teachers";
	public function classes()
	{
		return $this->hasMany('Classroom');
	}
}
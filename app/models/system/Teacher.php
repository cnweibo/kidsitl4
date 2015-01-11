<?php

class Teacher extends \Eloquent {
	protected $fillable = [];
	public function classes()
	{
		return $this->hasMany('Classroom');
	}
}
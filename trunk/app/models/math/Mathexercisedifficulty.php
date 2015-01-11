<?php

class Mathexercisedifficulty extends \Eloquent {
	protected $fillable = [];
	public function exercises()
	{
		return $this->hasMany('Mathexercise');
	}
}
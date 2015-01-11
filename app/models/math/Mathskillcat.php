<?php

class Mathskillcat extends \Eloquent {
	protected $fillable = [];
	public function skills()
	{
		return $this->hasMany('Mathskill');
	}
}
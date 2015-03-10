<?php

class Mathskillcat extends \Eloquent {
	protected $fillable = [];
	public $table = "mathskillcats";
	public function skills()
	{
		return $this->hasMany('Mathskill');
	}
}
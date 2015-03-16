<?php

class Grade extends \Eloquent {
	protected $fillable = [];
	public function mathskills()
	{
		return $this->belongsToMany('Mathskill');
	}
}
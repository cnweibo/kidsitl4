<?php

class Mathskill extends \Eloquent {
	protected $fillable = [];
	public function category()
	{
		return $this->belongsTo('Mathskillcat','mathskillcat_id');
	}
	public function score()
	{
		return $this->hasMany('Mathscore');
	}
}
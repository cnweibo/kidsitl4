<?php

class Mathskill extends \Eloquent {
	protected $fillable = [];
	public function category()
	{
		return $this->belongsTo('Mathskillcat','mathskillcat_id')->select(array('id', 'catlabel','description'));
	}
	public function score()
	{
		return $this->hasMany('Mathscore');
	}
	public function grades()
	{
		return $this->belongsToMany('Grade');
	}
}
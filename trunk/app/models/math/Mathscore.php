<?php

class Mathscore extends \Eloquent {
	protected $fillable = [];
	public function belongingstudent()
	{
		return $this->belongsTo('Student','student_id');
	}
	public function belongingskill()
	{
		return $this->belongsTo('Mathskill','mathskill_id');
	}
}
<?php

class Mathexerciseopdata extends \Eloquent {
	protected $fillable = [];
	public function ownersession()
	{
		return $this->belongsTo('Mathexerciseopsession','mathexerciseopsession_id');
	}
}
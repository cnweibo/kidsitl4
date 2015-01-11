<?php

class Mathsyntheticalexamopdata extends \Eloquent {
	protected $fillable = [];
	public function belongingexam()
	{
		return $this->belongsTo('Mathsyntheticalexam','mathexam_id');
	}
	public function belongingstudent()
	{
		return $this->belongsTo('Student','student_id');
	}
	public function belongingexercise()
	{
		return $this->belongsTo('Mathexercise','mathexercise_id');
	}
}
<?php

class Mathsyntheticalexam extends \Eloquent {
	protected $fillable = [];
	public function owner()
	{
		return $this->belongsTo('Teacher','teacher_id');
	}
	public function rows()
	{
		return $this->hasMany('Mathsyntheticalexamrow');
	}
	public function opdata()
	{
		return $this->hasMany('Mathsyntheticalexamopdata');
	}
}
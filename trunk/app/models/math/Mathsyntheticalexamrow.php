<?php

class Mathsyntheticalexamrow extends \Eloquent {
	protected $fillable = [];
	public function belongingexam()
	{
		return $this->belongsTo('Mathsyntheticalexam','mathexam_id');
	}
}
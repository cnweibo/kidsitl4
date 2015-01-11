<?php

class Engskill extends \Eloquent {
	protected $guarded = [];
	public $table = "engskill";
	public function skillcats(){
		return $this->belongsTo('Engskillcat');
	}
}
<?php

class Engskillscat extends \Eloquent {
	protected $guarded = [];
	public $table = "engskillscat";
	public function skills(){
		return $this->hasMany('Engskill');
	}
}
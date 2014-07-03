<?php

class Fayinguize extends \Eloquent {
	protected $guarded = [];
	public $table = "fayinguizes";
	public function yinbiao(){
		return $this->hasMany('Yinbiao');
	}
}
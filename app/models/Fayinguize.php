<?php

class Fayinguize extends \Eloquent {
	protected $guarded = [];
	public $table = "fayinguizes";
	public function relatedwords(){
		return $this->belongsToMany('Relatedword');
	}
	public function yinbiao(){
		return $this->belongsTo('Yinbiao');
	}	
}
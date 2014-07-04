<?php

class Fayinguize extends \Eloquent {
	protected $guarded = [];
	public $table = "fayinguizes";
	public function relatedwords(){
		return $this->hasMany('Relatedword');
	}
	public function yinbiao(){
		return $this->belongsTo('Yinbiao');
	}	
}
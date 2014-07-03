<?php

class Relatedword extends \Eloquent {
	protected $guarded = [];
	public $table = "relatedwords";
	public function yinbiaos(){
		return $this->belongsToMany('Yinbiao');
	}
	public function fayinguize(){
		return $this->belongsTo('Fayinguize');
	}
}
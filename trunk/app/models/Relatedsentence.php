<?php

class Relatedsentence extends \Eloquent {
	protected $guarded = [];
	public $table = "relatedsentences";
	public function relatedwords(){
		return $this->belongsToMany('Relatedword');
	}
}
<?php

class Relatedword extends \Eloquent {
	protected $guarded = [];
	public $table = "relatedwords";
	// remove the relation between word and yinbiao
	// public function yinbiaos(){
	// 	return $this->belongsToMany('Yinbiao');
	// }
	public function fayinguize(){
		return $this->belongsToMany('Fayinguize');
	}
	public function relatedsentences(){
		return $this->belongsToMany('Relatedsentence');
	}

}
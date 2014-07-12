<?php

class Yinbiao extends \Eloquent {
	protected $guarded = [];
	public $table = "yinbiaos";
	public function yinbiaocategory(){
		return $this->belongsTo('Yinbiaocategory');
	}
	// remove the relation between yinbiao and word.This relation works
	// by help of fayinguize table
	// public function relatedwords(){
	// 	return $this->belongsToMany('Relatedword');
	// }
	public function fayinguizes(){
		return $this->hasMany('Fayinguize');
	}	
}
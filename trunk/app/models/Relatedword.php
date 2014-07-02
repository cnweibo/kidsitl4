<?php

class Relatedword extends \Eloquent {
	protected $guarded = [];
	public $table = "relatedwords";
	public function yinbiaocategory(){
		return $this->belongsTo('Yinbiaocategory');
	}
	public function yinbiaos(){
		return $this->belongsToMany('Yinbiao');
	}
}
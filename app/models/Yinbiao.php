<?php

class Yinbiao extends \Eloquent {
	protected $guarded = [];
	public $table = "yinbiaos";
	public function yinbiaocategory(){
		return $this->belongsTo('Yinbiaocategory');
	}
	public function relatedwords(){
		return $this->belongsToMany('Relatedword');
	}
	public function fayinguizes(){
		return $this->hasMany('Fayinguize');
	}	
}
<?php

class Yinbiaocategory extends \Eloquent {
	protected $guarded = [];
	public $table = "yinbiaocategories";
	public function yinbiao(){
		return $this->hasMany('Yinbiao');
	}
}
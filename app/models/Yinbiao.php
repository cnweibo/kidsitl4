<?php

class Yinbiao extends \Eloquent {
	protected $guarded = [];
	public $table = "yinbiaos";
	public function yinbiaocategory(){
		return $this->belongsTo('Yinbiaocategory');
	}
}
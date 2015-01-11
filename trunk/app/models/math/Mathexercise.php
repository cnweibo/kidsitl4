<?php

class Mathexercise extends \Eloquent {
	protected $fillable = [];
	public $table = "mathexercises";
	public function exercisecat(){
		// 注意：这里最好指定belongsTo所对应的key column名称，否则可能由于
		// 命名convention的问题导致不能正确返回对应的belongto relation!!!
		return $this->belongsTo('Mathexercisecat','mathexercisecat_id');	
	}
	public function difficulty()
	{
		return $this->belongsTo('Mathexercisedifficulty','mathexercisedifficulty_id');
	}
}
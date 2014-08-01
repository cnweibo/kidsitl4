<?php

class Guestaddedword extends Eloquent {
    protected $guarded = array();

    public static $rules = array();
    public function getapprovedAttribute($value){
    	return ($value ? "是" : "否");
    }


}
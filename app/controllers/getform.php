<?php

class getformController extends BaseController {

    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        parent::__construct();
    }

    public index(){
    	View::make('sandstudy.getform');
    }

}
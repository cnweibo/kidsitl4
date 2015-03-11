<?php

class AdminMathindexController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "数学知识点类别管理";
		return View::make('admin.mathindex.index',compact('title'));
	}

}
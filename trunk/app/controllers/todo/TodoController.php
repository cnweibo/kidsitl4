<?php
/* TodoController.php created by zhenghua@kidsit.cn on 30/11/2014 */

class TodoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Todo::all();
	}

	/**
	 * Display the index html on request from non-ajax.
	 *
	 * @return Response
	 */
	public function indexhtml()
	{
		Give::javascript(['csrf_token'=> csrf_token()]);
		return View::make('site.todo.index');
	}
	 

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$newTodo = new Todo;
		$todoTitle = Input::get('title');
		if($todoTitle){
			$newTodo ->title = $todoTitle;
			$newTodo ->completed = 0;
			$newTodo ->save();
		}
		return Response::json(['status' => 'ok'],200);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  
	 * @return Response
	 */
	public function show()
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  
	 * @return Response
	 */
	public function edit()
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  
	 * @return Response
	 */
	public function update()
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  
	 * @return Response
	 */
	public function destroy()
	{
		//
	}


}

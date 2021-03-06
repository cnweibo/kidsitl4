<?php

class FayinguizeController extends BaseController {

    /**
     * Yinbiao Model
     * @var Yinbiao
     */
    protected $fayinguize;
    /**
     * Inject the models.
     * @param Yinbiao $fayinguize
     */
    public function __construct()
    {
        parent::__construct();

        // $this->post = $post;
        // $this->user = $user;
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Get all the blog posts
		$fayinguizes = Fayinguize::all();
		return View::make('site.fayinguize.index',compact('fayinguizes'));
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fayinguize = Fayinguize::find($id);
		return View::make('site.fayinguize.show',compact('fayinguize'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

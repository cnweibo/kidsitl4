<?php

class AdminGuestaddedwordsController extends AdminController {

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the guestaddedwords available
		// Title
		$title = "访客新创单词管理";
		// Show the page
		return View::make('admin/guestaddedwords/index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "新建发音规则";
        // Show the page
        return View::make('admin/guestaddedwords/create',compact('title'));
	}
	/**
	 * process the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
 
		// Declare the rules for the form validation
		$rules = array(
		    'title'   => 'required',
		    'description' => 'required',
		    'yinbiao_id' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$title = new Guestaddedword;
			$title->title = Input::get('title');
			$title->description = Input::get('description');
			$title->yinbiao_id = Input::get('yinbiao_id');
			$title->save();
		}
	  
	        $title = "新建发音规则";
	        // redirect with success
	        return Redirect::to('admin/guestaddedwords/create')->with('success', Lang::get('admin/blogs/messages.create.success'));       
	}
	/**
	 * show a form to edit resource in storage.
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Title
        $title = "更改发音规则：";
        $fayinguizeModel = Guestaddedword::find($id);
        // Show the page
        return View::make('admin/guestaddedwords/fayinguizeedit', compact('fayinguizeModel', 'title'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postEdit($id)
	{
		// Declare the rules for the form validation
		$rules = array(
			'id'   => 'required',
		    'title'   => 'required',
		    'description' => 'required',
		    // 'regex' => 'required',
		    'yinbiao_id' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$fayinguizetemp = Guestaddedword::findOrFail(Input::get('id'));
			// dd($fayinguizetemp);
		    if($fayinguizetemp->update(array('title' =>Input::get('title'),'description'=>Input::get('description'),'yinbiao_id'=>Input::get('yinbiao_id'),'regex'=>Input::get('regex'))));
		    {
		        // Redirect to the new blog post page
		        return Redirect::to('admin/guestaddedwords/' . $fayinguizetemp->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/guestaddedwords/' . $fayinguizetemp->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/guestaddedwords/' . $fayinguizetemp->id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($fayinguize)
	{
		// Title
        $title = "删除发音规则：";
        // Show the page
        return View::make('admin/guestaddedwords/delete', compact('fayinguize', 'title'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postDelete($id)
	{
	    // Declare the rules for the form validation
	    $rules = array(
	        // 'id' => 'required|integer'
	    );
	    // Validate the inputs
	    $validator = Validator::make(Input::all(), $rules);
	    // Check if the form validates with success
	    if ($validator->passes())
	    {
	    	$yinbiaocattodelete = Guestaddedword::find($id);
	    	// dd($yinbiaocattodelete);
	    	$yinbiaocattodelete->delete();
	        // Was the id deleted?
	        $yinbiaofound = Guestaddedword::find($id);
	        if(empty($yinbiaofound))
	        {
	            // Redirect to the yinbiao management page
	            return Redirect::to('admin/guestaddedwords')->with('success', "音标类别删除成功！");
	        }
	    }
	    // There was a problem deleting the yinbiao
	    return Redirect::to('admin/guestaddedwords')->with('error', "音标类别删除错误，请重试");
	}	

	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $guestaddedwords = Guestaddedword::select(array('guestaddedwords.id', 'guestaddedwords.wordtext', 'guestaddedwords.approved as approvedstatus', 'guestaddedwords.created_at'));
        return Datatables::of($guestaddedwords)        
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
    }
}
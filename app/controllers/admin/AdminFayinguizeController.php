<?php

class AdminFayinguizeController extends AdminController {

	 /**
     * Yinbiao Model
     * @var Post
     */
	protected $fayinguizes;
    /**
     * Inject the models.
     * @param Yinbiao $yinbiao
     */
    public function __construct(Fayinguize $fayinguizes)
    {
        parent::__construct();
        $this->fayinguizes = $fayinguizes;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the fayinguizes available
		// Title
		$title = "发音规则管理";
		// Show the page
		return View::make('admin/fayinguizes/index', compact('title'));
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
        return View::make('admin/fayinguizes/create',compact('title'));
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
			$title = new Fayinguize;
			$title->title = Input::get('title');
			$title->description = Input::get('description');
			$title->yinbiao_id = Input::get('yinbiao_id');
			$title->save();
		}
	  
	        $title = "新建发音规则";
	        // redirect with success
	        return Redirect::to('admin/fayinguizes/create')->with('success', Lang::get('admin/blogs/messages.create.success'));       
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
        $fayinguizeModel = Fayinguize::find($id);
        // Show the page
        return View::make('admin/fayinguizes/fayinguizeedit', compact('fayinguizeModel', 'title'));
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
		    'yinbiao_id' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$fayinguizetemp = Fayinguize::findOrFail(Input::get('id'));
			// dd($fayinguizetemp);
		    if($fayinguizetemp->update(array('title' =>Input::get('title'),'description'=>Input::get('description'),'yinbiao_id'=>Input::get('yinbiao_id'))));
		    {
		        // Redirect to the new blog post page
		        return Redirect::to('admin/fayinguizes/' . $fayinguizetemp->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/fayinguizes/' . $fayinguizetemp->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/fayinguizes/' . $fayinguizetemp->id . '/edit')->withInput()->withErrors($validator);
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
        return View::make('admin/fayinguizes/delete', compact('fayinguize', 'title'));

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
	    	$yinbiaocattodelete = Fayinguize::find($id);
	    	// dd($yinbiaocattodelete);
	    	$yinbiaocattodelete->delete();
	        // Was the id deleted?
	        $yinbiaofound = Fayinguize::find($id);
	        if(empty($yinbiaofound))
	        {
	            // Redirect to the yinbiao management page
	            return Redirect::to('admin/fayinguizes')->with('success', "音标类别删除成功！");
	        }
	    }
	    // There was a problem deleting the yinbiao
	    return Redirect::to('admin/fayinguizes')->with('error', "音标类别删除错误，请重试");
	}	

	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $fayinguizes = Fayinguize::select(array('fayinguizes.id', 'fayinguizes.title', 'fayinguizes.description', 'fayinguizes.yinbiao_id as yinbiao','fayinguizes.created_at'));
        return Datatables::of($fayinguizes)
        ->edit_column('yinbiao', '<a href="{{URL::to(\'admin/yinbiaos\')}}">{{($yinbiao)?Yinbiao::find($yinbiao)->name:""}}</a>')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/fayinguizes/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/fayinguizes/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
    }
}
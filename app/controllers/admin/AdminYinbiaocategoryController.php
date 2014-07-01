<?php

class AdminYinbiaocategoryController extends AdminController {

	 /**
     * Yinbiao Model
     * @var Post
     */
	protected $yinbiaocats;
    /**
     * Inject the models.
     * @param Yinbiao $yinbiao
     */
    public function __construct(Yinbiaocategory $yinbiaocats)
    {
        parent::__construct();
        $this->yinbiaocats = $yinbiaocats;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the yinbiaocats available
		// Title
		$title = "音标类别管理";
		// Show the page
		return View::make('admin/yinbiaocategory/index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "新建音标类别";
        $yinbiaocats = Yinbiaocategory::all();
        // Show the page
        return View::make('admin/yinbiaocategory/create', compact('yinbiaocats','title'));
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
		    'yinbiaocat'   => 'required',
		    'description' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$yinbiaocat = new Yinbiaocategory;
			$yinbiaocat->ybcategory = Input::get('yinbiaocat');
			$yinbiaocat->description = Input::get('description');
			$yinbiaocat->save();
		}
	  
	        $title = "新建音标类别";
	        $yinbiaocats = Yinbiaocategory::all();
	        // Show the page
	        return View::make('admin/yinbiaocategory/create', compact('yinbiaocats','title'))->with('success', Lang::get('admin/blogs/messages.create.success'));       
	}
	/**
	 * show a form to edit resource in storage.
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Title
        $title = "更改音标类别：";
        $yinbiaocatModel = Yinbiaocategory::find($id);
        // Show the page
        return View::make('admin/Yinbiaocategory/yinbiaocatedit', compact('yinbiaocatModel', 'title'));
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
		    'yinbiaodescription'   => 'required',
		    'yinbiaocat' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$yinbiaocattemp = Yinbiaocategory::findOrFail(Input::get('id'));
			// dd($yinbiaocattemp);
		    if($yinbiaocattemp->update(array('ybcategory' =>Input::get('yinbiaocat'),'description'=>Input::get('yinbiaodescription'))));
		    {
		        // Redirect to the new blog post page
		        return Redirect::to('admin/yinbiaocategory/' . $yinbiaocattemp->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/yinbiaocategory/' . $yinbiaocattemp->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/yinbiaocategory/' . $yinbiaocattemp->id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($yinbiao)
	{
		// Title
        $title = "删除音标";
        // Show the page
        return View::make('admin/yinbiaos/delete', compact('yinbiao', 'title'));

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
	    	$yinbiaotodelete = Yinbiao::find($id);
	    	// dd($yinbiaotodelete);
	    	$yinbiaotodelete->delete();
	        // Was the id deleted?
	        $yinbiaofound = Yinbiao::find($id);
	        if(empty($yinbiaofound))
	        {
	            // Redirect to the yinbiao management page
	            return Redirect::to('admin/yinbiaos')->with('success', "音标删除成功！");
	        }
	    }
	    // There was a problem deleting the yinbiao
	    return Redirect::to('admin/yinbiaos')->with('error', "音标删除错误，请重试");
	}	

	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $yinbiaocats = Yinbiaocategory::select(array('yinbiaocategories.id', 'yinbiaocategories.ybcategory', 'yinbiaocategories.description', 'yinbiaocategories.created_at'));
        return Datatables::of($yinbiaocats)

        // ->edit_column('hanzi', '{{ DB::table(\'hanzi\')->where(\'hanzi\', \'=\', $hanzi)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/yinbiaocategory/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/yinbiaocategory/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
    }
}
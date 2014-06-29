<?php

class AdminYinbiaosController extends AdminController {

	 /**
     * Yinbiao Model
     * @var Post
     */
	protected $yinbiaos;
    /**
     * Inject the models.
     * @param Yinbiao $yinbiao
     */
    public function __construct(Yinbiao $yinbiaos)
    {
        parent::__construct();
        $this->yinbiaos = $yinbiaos;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the yinbiaos available
		// Title
		$title = "音标管理";

		// Grab all the blog posts
		$yinbiaos = $this->yinbiaos;

		// Show the page
		return View::make('admin/yinbiaos/index', compact('yinbiaos', 'title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "新建笔顺";

        // Show the page
        return View::make('admin/yinbiaos/create', compact('title'));
	}
	/**
	 * process the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function postCreate()
	{

	    if (Input::hasFile('filename')){
	        $file= Input::file('filename');
	        // dd(app_path().'/storage/uploaded/','uploaded.xxx');
	        $destfile = time().'_'.rand(1,10).'.'.$file->getClientOriginalExtension();
	        $destabsolutefile = app_path().'/storage/uploaded/';
	        $file->move($destabsolutefile,$destfile);
	        $bishun = new Yinbiao;
	        $bishun->hanzi = Input::get('hanzi');
	        $bishun->filename = $destfile;
	        $bishun->relatedwords = Input::get('relatedwords');
	        $bishun->save();    
	        // return [
	        //     'path'=> $file->getRealPath(),
	        //     'size'=> $file->getSize(),
	        //     'mime'=> $file->getMimeType(),
	        //     'name'=> $file->getClientOriginalName(),
	        //     'extension'=> $file->getClientOriginalExtension()
	        // ];
	        // Title
	        $title = "新建笔顺";
	        
	        // Show the page
	        return View::make('admin/yinbiaos/create', compact('title'))->with('success', Lang::get('admin/blogs/messages.create.success'));
	    }        
	}
	/**
	 * show a form to edit resource in storage.
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Title
        $title = "更改音标：";
        $yinbiaosModel = Yinbiao::find($id);
        // Show the page
        return View::make('admin/yinbiaos/yinbiaoedit', compact('yinbiaosModel', 'title'));
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
		    'yinbiao'   => 'required',
		    'yinbiaocategory_id' => 'required',
		    'mp3' => 'required|min:2'
		);
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
		    // $this->yinbiaos->hanzi            = Input::get('hanzi');
			$yinbiaotemp = Yinbiao::find(Input::get('id'))->first();
		    if($yinbiaotemp->update(array('yinbiaocategory_id' =>Input::get('yinbiaocategory_id'),'mp3'=>Input::get('mp3'))));
		    {
		        // Redirect to the new blog post page
		        return Redirect::to('admin/yinbiaos/' . $yinbiaotemp->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/yinbiaos/' . $yinbiaotemp->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/yinbiaos/' . $yinbiaotemp->id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function getDelete($bishun)
	{
		// Title
        $title = Lang::get('admin/yinbiaos/title.blog_delete');

        // Show the page
        return View::make('admin/yinbiaos/delete', compact('bishun', 'title'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postDelete($bishun)
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
	    	var_dump(gettype($bishun));
	    	var_dump(gettype(Input::get('hanzi')));
	    	$bishuntodelete = Yinbiao::wherehanzi($bishun)->first();
	    	$bishuntodelete->delete();
	        // Was the bishun deleted?
	        $bishunfound = Yinbiao::wherehanzi($bishun);
	        if(empty($bishunfound))
	        {
	            // Redirect to the bishun management page
	            return Redirect::to('admin/yinbiaos')->with('success', "笔顺删除成功！");
	        }
	    }
	    // There was a problem deleting the bishun
	    return Redirect::to('admin/yinbiaos')->with('error', "笔顺删除错误，请重试");
	}	

	/**
     * Show a list of all the bishun formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $yinbiaos = Yinbiao::select(array('yinbiaos.id', 'yinbiaos.name', 'yinbiaos.yinbiaocategory_id','yinbiaos.mp3', 'yinbiaos.created_at'));

        return Datatables::of($yinbiaos)

        // ->edit_column('hanzi', '{{ DB::table(\'hanzi\')->where(\'hanzi\', \'=\', $hanzi)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/yinbiaos/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/yinbiaos/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}
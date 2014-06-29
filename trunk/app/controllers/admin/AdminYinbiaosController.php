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
     * Show a list of all the yinbiao formatted for Datatables.
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
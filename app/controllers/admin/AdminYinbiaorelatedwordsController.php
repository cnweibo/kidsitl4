<?php

class AdminYinbiaorelatedwordsController extends AdminController {

	 /**
     * Yinbiao Model
     * @var Post
     */
	protected $yinbiaorelatedwords;
    /**
     * Inject the models.
     * @param Yinbiao $yinbiao
     */
    public function __construct(Relatedword $yinbiaorelatedwords)
    {
        parent::__construct();
        $this->yinbiaorelatedwords = $yinbiaorelatedwords;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the yinbiaorelatedwords available
		// Title
		$title = "音标相关单词管理";
		// Show the page
		return View::make('admin/yinbiaorelatedwords/index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "新建音标相关单词";
        $yinbiaorelatedwords = Relatedword::all();
        // Show the page
        return View::make('admin/yinbiaorelatedwords/create', compact('yinbiaorelatedwords','title'));
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
		    'wordyinbiao' => 'required',
		    'wordtext' => 'required',
		    'mp3' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			if (Input::hasFile('mp3')){
		        $file= Input::file('mp3');
		        $destfile = time().'_'.rand(1,10).'.'.$file->getClientOriginalExtension();
		        $destabsolutefile = app_path().'/storage/uploaded/yinbiaomp3/';
		        $file->move($destabsolutefile,$destfile);
		        // 创建新相关单词
				$yinbiaorelatedword = new Relatedword;
				$yinbiaorelatedword->wordtext = Input::get('wordtext');
				$yinbiaorelatedword->wordyinbiao = Input::get('wordyinbiao');
				$yinbiaorelatedword->fayinguize_id = Input::get('fayinguize_id');
				$yinbiaorelatedword->mp3 = $destfile;
				$yinbiaorelatedword->save();
			}
			// dd($yinbiaorelatedword);
		}
	  
	        $title = "新建音标相关单词";
	        $yinbiaorelatedwords = Relatedword::all();
	        // Redirect to the create page
		    return Redirect::to('admin/yinbiaorelatedwords/create')->with('success', Lang::get('admin/blogs/messages.update.success'));
	}
	/**
	 * show a form to edit resource in storage.
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Title
        $title = "更改音标相关单词：";
        $relatedword = Relatedword::find($id);
        // Show the page
        return View::make('admin/yinbiaorelatedwords/wordedit', compact('relatedword', 'title'));
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
		    'wordyinbiao'   => 'required',
		    'wordtext' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		$relatedword = Relatedword::findOrFail(Input::get('id'));
		if ($validator->passes())
		{
			if (Input::hasFile('mp3')){
		        $file= Input::file('mp3');
		        $destfile = time().'_'.rand(1,10).'.'.$file->getClientOriginalExtension();
		        $destabsolutefile = app_path().'/storage/uploaded/yinbiaomp3/';
		        $file->move($destabsolutefile,$destfile);
			}else{
				$destfile=Input::get('originalmp3');
			}
			// dd($relatedword);
			// 更改新相关单词
		    if($relatedword->update(array('wordtext' =>Input::get('wordtext'),'wordyinbiao'=>Input::get('wordyinbiao'),'mp3'=>$destfile,'fayinguize_id'=>Input::get('fayinguize_id'))));
		    {
		        // Redirect to the new blog post page
		        return Redirect::to('admin/yinbiaorelatedwords/' . $relatedword->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/yinbiaorelatedwords/' . $relatedword->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/yinbiaorelatedwords/' . $relatedword->id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($relatedword)
	{
		// Title
        $title = "删除音标类别：";
        // Show the page
        return View::make('admin/yinbiaorelatedwords/delete', compact('relatedword', 'title'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postDelete($id)
	{
    	$relatedwordtodelete = Relatedword::find($id);
    	$relatedwordtodelete->delete();
        // Was the id deleted?
        $yinbiaofound = Relatedword::find($id);
        if(empty($yinbiaofound))
        {
            // Redirect to the yinbiao management page
            return Redirect::to('admin/yinbiaorelatedwords')->with('success', "单词删除成功！");
        }
	    // There was a problem deleting the yinbiao
	    return Redirect::to('admin/yinbiaorelatedwords')->with('error', "单词删除错误，请重试");
	}	

	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $yinbiaorelatedwords = Relatedword::select(array('relatedwords.id', 'relatedwords.wordtext', 'relatedwords.wordyinbiao','relatedwords.mp3','relatedwords.fayinguize_id as fayinguize','relatedwords.created_at'));
        return Datatables::of($yinbiaorelatedwords)

        ->edit_column('fayinguize', '{{($fayinguize)?Fayinguize::find($fayinguize)->title:""}}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/yinbiaorelatedwords/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/yinbiaorelatedwords/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
    }
}
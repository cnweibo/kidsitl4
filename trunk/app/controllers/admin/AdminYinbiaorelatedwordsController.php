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
 		// $input = $_POST['fayinguize_id'];
		// Declare the rules for the form validation
		$rules = array(
		    'wordyinbiao' => 'required',
		    'wordtext' => 'required',
		    // 'mp3' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		if ($validator->passes())
		{
			$destfile = 'Not_defined';
			if (Input::hasFile('mp3')){
		        $file= Input::file('mp3');
		        $destfile = time().'_'.rand(1,10).'.'.$file->getClientOriginalExtension();
		        $destabsolutefile = app_path().'/storage/uploaded/yinbiaomp3/';
		        $file->move($destabsolutefile,$destfile);
		    }   
		        // 创建新相关单词
				$yinbiaorelatedword = new Relatedword;
				$yinbiaorelatedword->wordtext = Input::get('wordtext');
				$yinbiaorelatedword->wordyinbiao = Input::get('wordyinbiao');				
				$yinbiaorelatedword->mp3 = $destfile;
				$yinbiaorelatedword->save();
				
				//save the fayinguize_id in the pivot table
				foreach (Input::get('fayinguize_id') as $fayinguize_id) {
					$yinbiaorelatedword->fayinguize()->attach($fayinguize_id);
					$previousguizeoperated = new Prevguizeoperated;
					$previousguizeoperated ->prevguize_id = $fayinguize_id;
					$previousguizeoperated ->save();
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
		    if($relatedword->update(array('wordtext' =>Input::get('wordtext'),'wordyinbiao'=>Input::get('wordyinbiao'),'mp3'=>$destfile,)));
		    {
		    	//detach all the fayinguize_id in the pivot table first
				$relatedword->fayinguize()->detach();
				// die();
		    	//then save the fayinguize_id in the pivot table
				foreach (Input::get('fayinguize_id') as $fayinguize_id) {
					$relatedword->fayinguize()->attach($fayinguize_id);
				}
				if (Input::has('fayinguize_preselected')){ 
					foreach (Input::get('fayinguize_preselected') as $fayinguize_preselected){ 
						$relatedword->fayinguize()->attach($fayinguize_preselected);
					}
				}
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
    	// detach the relation between the word and fayinguize pivot table
    	if($relatedwordtodelete->fayinguize){
    		$relatedwordtodelete->fayinguize()->detach();
    	}
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
	public static function printyinbiao()
	{
		return '<a href="{{URL::to(\'admin/fayinguizes\')}}">{{(Relatedword::find($id)->fayinguize)?Relatedword::find($id)->fayinguize()->first()->title:""}}</a> 所属音标：<a href="{{URL::to(\'admin/yinbiaos\')}}">{{(Relatedword::find($id)->fayinguize)?Relatedword::find($id)->fayinguize()->first()->yinbiao->name:""}}</a>';
	}
	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $yinbiaorelatedwords = Relatedword::select(array('relatedwords.id', 'relatedwords.wordtext', 'relatedwords.wordyinbiao','relatedwords.mp3','relatedwords.created_at'));
        return Datatables::of($yinbiaorelatedwords)
        ->add_column('fayinguize', '<?php for($i=0;$i<Relatedword::find($id)->fayinguize()->count();$i++){echo  \'<a class="adminfayinguizehref" href="http://kidsit.cn/admin/fayinguizes">\'.Relatedword::find($id)->fayinguize[$i]->title.\'</a>\'."属于".\'<a class="adminyinbiaohref" href="http://kidsit.cn/admin/yinbiaos">\'.Relatedword::find($id)->fayinguize[$i]->yinbiao->name.\'</a>\'." ";}?>')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/yinbiaorelatedwords/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/yinbiaorelatedwords/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
      /*  ->add_column('fayinguize', '<?php for($i=0;$i<2;$i++){echo "<a href=".URL::to(\'admin/fayinguizes\').">".Relatedword::find($id)->fayinguize()->first()->title."</a> 所属音标：<a href=".URL::to(\'admin/yinbiaos\').">".Relatedword::find($id)->fayinguize()->first()->yinbiao->name."</a>";}?>')
*/
    }
    public function getGuizeSearch()
    {
    	$guize=Input::get('guizesearch');
    	return Fayinguize::where('title','LIKE',"%$guize%")->get(array('title','id'))->toArray();
    }
}
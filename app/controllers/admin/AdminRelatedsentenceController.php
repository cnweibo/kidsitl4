<?php

class AdminRelatedsentenceController extends AdminController {

	 /**
     * Yinbiao Model
     * @var Post
     */
	protected $relatedsentences;
    /**
     * Inject the models.
     * @param Yinbiao $yinbiao
     */
    public function __construct(Relatedsentence $relatedsentences)
    {
        parent::__construct();
        $this->relatedsentences = $relatedsentences;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//list the relatedsentences available
		// Title
		$title = "例句管理";
		// Show the page
		return View::make('admin/relatedsentences/index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "新建例句";
        $relatedsentences = Relatedsentence::all();
        // Show the page
        return View::make('admin/relatedsentences/create', compact('relatedsentences','title'));
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
		    'sentencetext' => 'required',
		    // 'mp3' => 'required'
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
			}
	        // 创建新相关单词
			$relatedsentence = new Relatedsentence;
			$relatedsentence->sentencetext = Input::get('sentencetext');				
			if (Input::hasFile('mp3')){$relatedsentence->mp3 = $destfile;}
			$relatedsentence->save();
			//detach all the fayinguize_id in the pivot table first
			if(Input::has('relatedword_id')){
		    	//then save the fayinguize_id in the pivot table
				foreach (Input::get('relatedword_id') as $relatedword_id) {
					$relatedsentence->relatedwords()->attach($relatedword_id);
					$newwordoperated =new Previousewordid;
					$newwordoperated ->relatedwordid = $relatedword_id;
					$newwordoperated ->save();
				}
			}
	  		$title = "新建例句";
	        $relatedsentences = Relatedsentence::all();
	        // Redirect to the create page
		    return Redirect::to('admin/relatedsentences/create')->with('success', Lang::get('admin/blogs/messages.update.success'));
		}
		// Form validation failed
		return Redirect::to('admin/relatedsentences/create')->withInput()->withErrors($validator);

	}
	/**
	 * show a form to edit resource in storage.
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Title
        $title = "更改例句：";
        $relatedsentence = Relatedsentence::find($id);
        // Show the page
        return View::make('admin/relatedsentences/edit', compact('relatedsentence', 'title'));
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
		    // 'mp3'   => 'required',
		    'sentencetext' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		// Check if the form validates with success
		$relatedsentence = Relatedsentence::findOrFail(Input::get('id'));
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
			// dd($relatedsentence);
			// 更改新相关单词
		    if($relatedsentence->update(array('sentencetext' =>Input::get('sentencetext'),'mp3'=>$destfile)));
		    {
		    	//detach all the fayinguize_id in the pivot table first
				$relatedsentence->relatedwords()->detach();
				// die();
		    	//then save the fayinguize_id in the pivot table
				foreach (Input::get('relatedword_id') as $relatedword_id) {
					$relatedsentence->relatedwords()->attach($relatedword_id);
				}
		        // Redirect to the new blog post page
		        return Redirect::to('admin/relatedsentences/' . $relatedsentence->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
		    }

		    // Redirect to the blogs post management page
		    return Redirect::to('admin/relatedsentences/' . $relatedsentence->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/relatedsentences/' . $relatedsentence->id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($relatedsentence)
	{
		// Title
        $title = "删除例句：";
        // Show the page
        return View::make('admin/relatedsentences/delete', compact('relatedsentence', 'title'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postDelete($id)
	{
    	$relatedwordtodelete = Relatedsentence::find($id);
    	$relatedwordtodelete->delete();
        // Was the id deleted?
        $sentencefound = Relatedsentence::find($id);
        if(empty($sentencefound))
        {
            // Redirect to the yinbiao management page
            return Redirect::to('admin/relatedsentences')->with('success', "单词删除成功！");
        }
	    // There was a problem deleting the yinbiao
	    return Redirect::to('admin/relatedsentences')->with('error', "单词删除错误，请重试");
	}	
	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $relatedsentences = Relatedsentence::select(array('relatedsentences.id', 'relatedsentences.sentencetext','relatedsentences.mp3','relatedsentences.created_at'));
        return Datatables::of($relatedsentences) 
        ->add_column('suoshuword', '<?php for($i=0;$i<Relatedsentence::find($id)->Relatedwords()->count();$i++){echo  \'<a class="adminsuoshuwordhref" href="http://kidsit.cn/admin/yinbiaorelatedwords">\'.Relatedsentence::find($id)->Relatedwords[$i]->wordtext.\'</a>\'." ";}?>')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/relatedsentences/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/relatedsentences/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
        
        ->make();
      /*  ->add_column('fayinguize', '<?php for($i=0;$i<2;$i++){echo "<a href=".URL::to(\'admin/fayinguizes\').">".Relatedsentence::find($id)->fayinguize()->first()->title."</a> 所属音标：<a href=".URL::to(\'admin/yinbiaos\').">".Relatedsentence::find($id)->fayinguize()->first()->yinbiao->name."</a>";}?>')
*/
    }
    public function getWordSearch()
    {
    	$word=Input::get('wordsearch');
    	return Relatedword::where('wordtext','LIKE',"%$word%")->get(array('wordtext','id'))->toArray();
    }
}
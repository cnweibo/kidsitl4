<?php

class AdminGuestaddedwordsController extends AdminController {

	 
    /**
     * 
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
		$title = "访客所创相关单词管理";
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
        $title = "新建音标类别";
        $guestaddedwords = Guestaddedword::all();
        // Show the page
        return View::make('admin/yinbiaocategory/create', compact('guestaddedwords','title'));
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
			$yinbiaocat = new Guestaddedword;
			$yinbiaocat->ybcategory = Input::get('yinbiaocat');
			$yinbiaocat->description = Input::get('description');
			$yinbiaocat->save();
		}
	  
	        $title = "新建音标类别";
	        $guestaddedwords = Guestaddedword::all();
	        // Show the page
	        return View::make('admin/yinbiaocategory/create', compact('guestaddedwords','title'))->with('success', Lang::get('admin/blogs/messages.create.success'));       
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
        $yinbiaocatModel = Guestaddedword::find($id);
        // Show the page
        return View::make('admin/yinbiaocategory/yinbiaocatedit', compact('yinbiaocatModel', 'title'));
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
			$yinbiaocattemp = Guestaddedword::findOrFail(Input::get('id'));
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
	public function getDelete($guestaddedword)
	{
		Guestaddedword::find($guestaddedword)->delete();
        return Redirect::to('admin/guestaddedwords');

	}
	/**
	 * enable .
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEnable($guestaddedword)
	{
		Guestaddedword::find($guestaddedword)->update(array('approved' =>1));
	    return Redirect::to('admin/guestaddedwords');

	}
	/**
	 * accept to fayinguize and yinbiao relationship .
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAccept($guestaddedword)
	{
		// 创建新相关单词
		$yinbiaorelatedword = new Relatedword;
		if (Relatedword::where('wordtext','=',Guestaddedword::find($guestaddedword)->wordtext)->first()){
			// dd(Relatedword::where('wordtext',Guestaddedword::find($guestaddedword)->wordtext));
			// dd(Relatedword::where('wordtext','=',Guestaddedword::find($guestaddedword)->wordtext)->first()->fayinguize->first());
			$arrayvar = Relatedword::where('wordtext','=',Guestaddedword::find($guestaddedword)->wordtext)->first()->fayinguize->all();
			$arraycount = count(Relatedword::where('wordtext','=',Guestaddedword::find($guestaddedword)->wordtext)->first()->fayinguize->all());
			for ($i=0;$i<$arraycount;$i++) {
				if (Guestaddedword::find($guestaddedword)->fayinguizeid == $arrayvar[$i]->id)
					return Redirect::to('admin/guestaddedwords')->with('error', Guestaddedword::find($guestaddedword)->wordtext."重复单词，请删除待审单词！");

			}
			// 已经存在相关单词，但是在该发音规则上还没有本单词，则update
			Relatedword::where('wordtext','=',Guestaddedword::find($guestaddedword)->wordtext)->first()->fayinguize()->attach(Guestaddedword::find($guestaddedword)->fayinguizeid);
			Guestaddedword::find($guestaddedword)->delete();	
			return Redirect::to('admin/guestaddedwords');
		}
		// 不存在相关单词，则新创
		$yinbiaorelatedword->wordtext = Guestaddedword::find($guestaddedword)->wordtext;
		$yinbiaorelatedword->wordyinbiao = "待添加";				
		$yinbiaorelatedword->mp3 = "待修改";
		$yinbiaorelatedword->yinjieshu = "待修改";
		$yinbiaorelatedword->save();
		//save the fayinguize_id in the pivot table
		$yinbiaorelatedword->fayinguize()->attach(Guestaddedword::find($guestaddedword)->fayinguizeid);
		$acceptedword = Guestaddedword::find($guestaddedword)->wordtext;
		$accepttofayinguize = Fayinguize::find(Guestaddedword::find($guestaddedword)->fayinguizeid)->title;
		Guestaddedword::find($guestaddedword)->delete();	
	    return Redirect::to('admin/guestaddedwords')->with('success', $acceptedword."单词已经被接收到发音规则：".$accepttofayinguize);

	}
	/**
	 * enable .
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDisable($guestaddedword)
	{
		Guestaddedword::find($guestaddedword)->update(array('approved' =>0));
        return Redirect::to('admin/guestaddedwords');

	}

	/**
     * Show a list of all the yinbiao category formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $guestaddedwords = Guestaddedword::select(array('guestaddedwords.id', 'guestaddedwords.wordtext','guestaddedwords.yinbiaoid as yinbiaoid','guestaddedwords.fayinguizeid as fayinguizeid', 'guestaddedwords.created_at','guestaddedwords.approved'));
        return Datatables::of($guestaddedwords)
        ->add_column('relatedwords', '<?php for($i=0;$i<((Fayinguize::find($fayinguizeid))? Fayinguize::find($fayinguizeid)->Relatedwords()->count(): 0);$i++){echo  \'<a class="adminfayinguizehref" href="http://kidsit.cn/admin/yinbiaorelatedwords">\'.Fayinguize::find($fayinguizeid)->relatedwords[$i]->wordtext.\'</a>\'." ";}?>')
        ->edit_column('yinbiaoid', '<a href="{{URL::to(\'admin/yinbiaos\')}}">{{($yinbiaoid)?Yinbiao::find($yinbiaoid)->name:""}}</a>')
        ->edit_column('fayinguizeid', '<a href="{{URL::to(\'admin/fayinguizes\')}}">{{($fayinguizeid)?(Fayinguize::find($fayinguizeid)? Fayinguize::find($fayinguizeid)->title):"Not found"}}</a>')
        // ->edit_column('hanzi', '{{ DB::table(\'hanzi\')->where(\'hanzi\', \'=\', $hanzi)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/disable\' ) }}}" class="btn btn-default btn-xs" >拒绝</a>
        	<a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/enable\' ) }}}" class="btn btn-default btn-xs" >Approve</a>
                <a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
            <a href="{{{ URL::to(\'admin/guestaddedwords/\' . $id . \'/accept\' ) }}}" class="btn btn-xs btn-primary">接收</a>')
        
        ->make();
    }
}
<?php

class AdminMathskillController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "数学知识点管理";
		return View::make('admin.mathskills.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Input::has('catsubid')){
			$catsubid = Input::get('catsubid');
		}
		if (Input::has('mathskillcat_id')){
			$mathskillcat_id = Input::get('mathskillcat_id');
		}
		if ((Input::has('catsubid')) && (Input::has('mathskillcat_id'))){
			$skillfound = Mathskill::where('catsubid','=',$catsubid)->where('mathskillcat_id','=',$mathskillcat_id)
														
														->with('category')->select(['id','catsubid','description','mathskillcat_id','created_at'])->get()->toArray();

			return Response::json(['resp' => ['data' => $skillfound],'code'=>0], $skillfound? 200 : 404); 
		} 
		// Mathskill::with('owner','students')->get(['sysname','teacher_id'])->toArray();
		// dd(DB::getQueryLog());
			return Response::json(['resp' => ['data' => Mathskill::with('category')->with('grades')->select(['id','catsubid','description','mathskillcat_id','created_at'])->get()->toArray()],'code'=>0],200); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建数学知识点";
		// feed the html partial template to angular 
		return View::make('admin.mathskills.create',compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
	    $mathskillcat = new Mathskill;
	    $mathskillcat->catsubid = Input::get('catsubid');
	    $mathskillcat->description = Input::get('description');
	    $mathskillcat->mathskillcat_id = Input::get('catid');
	    try {
		    $mathskillcat->save();	  
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $e->getMessage()]], 200);
	    		}
	    	return Response::json(['resp' => ['code' => 410, 'message' => $e->getMessage()]], 200);

	    }
	    return Response::json(['resp' => ['code' => 0, 'message' => $mathskillcat->catsubid . '创建成功！']], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (is_numeric($id)){
			$mathskillcat = Mathskill::find($id)->get(['id','catsubid','description','created_at'])->toArray();
			if (!$mathskillcat){
				return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
			}
			return Response::json(['resp' => ['data' => $mathskillcat,'code'=>0],200]); 
		}else{

			$mathskillcat = Mathskill::where('catsubid' , '=', $id)
			->get(['id','catsubid','description','created_at'])->toArray();
			if (!$mathskillcat){
				return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
			}else{
				return Response::json(['resp' => ['data' => Mathskill::where('catsubid' , '=', $id)->get(['id','catsubid','description','created_at'])->toArray()],'code'=>0],200); 
			}
		}
			
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
		$title = "数学知识点编辑";
		$mathskillcat = Mathskill::findOrFail($id);
		$gradeids = DB::table('mathskill')->orderBy('id')->lists('id');
		$currentgradekey = array_search($id, $gradeids);
		$preivousindex = $currentgradekey -1;
		$nextindex = $currentgradekey +1;
		$totoalids = count($gradeids);
		if ($currentgradekey==0) {
			$preivousindex = $totoalids-1;
			$nextindex = $currentgradekey+1;
		}
		if ($currentgradekey==($totoalids-1)) {
			$preivousindex = $currentgradekey-1;
			$nextindex = 0;
		}
		$previousid = $gradeids[$preivousindex];
		$nextid = $gradeids[$nextindex];
		return View::make('admin/api/mathskill/edit',compact('mathskillcat','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $newmathskillcat = Mathskill::find($id);
	    if (!$newmathskillcat){
	    	return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
	    }
	    if(Input::get('catsubid')) {$newmathskillcat->catsubid = Input::get('catsubid') ;}
	    if(Input::get('description')) {$newmathskillcat->description = Input::get('description');}
	    if(Input::get('mathskillcat_id')){$newmathskillcat->mathskillcat_id = Input::get('mathskillcat_id');}
	    try {
		    $newmathskillcat->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $newmathskillcat->catsubid . $e->getMessage()]], 200);
	    		}	
	    	return Response::json(['resp' => ['code' => 409, 'message' => $newmathskillcat->catsubid . $e->getMessage()]], 200);

	    }

		return Response::json(['resp' => ['code' => 0 , 'message' => $newmathskillcat->catsubid . "更新成功！"]], 200);
	}

	/**
	 * display page for deleting the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		//
		$title = "删除数学知识点";
		$mathskillcat = Mathskill::find($id);
		return View::make('admin/api/mathskill/delete',compact('title','mathskillcat'));
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
		$mathskillcat = Mathskill::find($id);
		if(!$mathskillcat){
			return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
		}
		$mathskillcat->delete();
		return Response::json(['resp' => ['code' => 0 , 'message' => $mathskillcat->sysname . "删除成功！"]], 200);
	}

	/**
     * Show a list of all the data formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$mathskill = Mathskill::select(array('mathskill.id', 'mathskill.skillgradetitle', 'mathskill.skillgradedescription as yinbiaocategory','mathskill.created_at'));
    	// $mathskill = Yinbiao::select(array('mathskill.id', 'mathskill.name', 'mathskill.yinbiaocategory_id as yinbiaocategory','mathskill.mp3', 'mathskill.created_at'));
    	return Datatables::of($mathskill)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/mathskillcat/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/mathskillcat/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
        // $mathskill = Mathskill::select(array('mathskill.id', 'mathskill.skillgradetitle', 'mathskill.skillgradedescription as yinbiaocategory', 'mathskill.created_at'));
        // return Datatables::of($mathskill)
        // ->remove_column('id')

        // ->make();
    }

}
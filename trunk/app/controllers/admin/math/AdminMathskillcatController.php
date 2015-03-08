<?php

class AdminMathskillcatController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "数学知识点类别管理";
		return View::make('admin.mathskillcats.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Mathskillcat::with('owner','students')->get(['sysname','teacher_id'])->toArray();
		// dd(DB::getQueryLog());
			return Response::json(['resp' => ['data' => Mathskillcat::select(['id','catlabel','description','created_at'])->get()->toArray()],'code'=>0],200); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建数学知识点类别";
		// feed the html partial template to angular 
		return View::make('admin.mathskillcats.create',compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
	    $mathskillcat = new Mathskillcat;
	    $mathskillcat->catlabel = Input::get('catlabel');
	    $mathskillcat->description = Input::get('description');

	    try {
		    $mathskillcat->save();	  
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $e->getMessage()]], 200);
	    		}
	    	return Response::json(['resp' => ['code' => 410, 'message' => $e->getMessage()]], 200);

	    }
	    return Response::json(['resp' => ['code' => 0, 'message' => $mathskillcat->catlabel . '创建成功！']], 200);
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
			$mathskillcat = Mathskillcat::find($id)->get(['id','catlabel','description','created_at'])->toArray();
			if (!$mathskillcat){
				return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
			}
			return Response::json(['resp' => ['data' => $mathskillcat,'code'=>0],200]); 
		}else{

			$mathskillcat = Mathskillcat::where('catlabel' , '=', $id)
			->get(['id','catlabel','description','created_at'])->toArray();
			if (!$mathskillcat){
				return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
			}else{
				return Response::json(['resp' => ['data' => Mathskillcat::where('catlabel' , '=', $id)->get(['id','catlabel','description','created_at'])->toArray()],'code'=>0],200); 
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
		$title = "数学知识点类别编辑";
		$mathskillcat = Mathskillcat::findOrFail($id);
		$gradeids = DB::table('mathskillcats')->orderBy('id')->lists('id');
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
		return View::make('admin/api/mathskillcats/edit',compact('mathskillcat','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $newmathskillcat = Mathskillcat::find($id);
	    if (!$newmathskillcat){
	    	return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
	    }
	    if(Input::get('catlabel')) {$newmathskillcat->catlabel = Input::get('catlabel') ;}
	    if(Input::get('description')) {$newmathskillcat->description = Input::get('description');}
	    try {
		    $newmathskillcat->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $newmathskillcat->catlabel . $e->getMessage()]], 200);
	    		}	
	    	return Response::json(['resp' => ['code' => 409, 'message' => $newmathskillcat->catlabel . $e->getMessage()]], 200);

	    }

		return Response::json(['resp' => ['code' => 0 , 'message' => $newmathskillcat->catlabel . "更新成功！"]], 200);
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
		$title = "删除数学知识点类别";
		$mathskillcat = Mathskillcat::find($id);
		return View::make('admin/api/mathskillcats/delete',compact('title','mathskillcat'));
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
		$mathskillcat = Mathskillcat::find($id);
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
    	$mathskillcats = Mathskillcat::select(array('mathskillcats.id', 'mathskillcats.skillgradetitle', 'mathskillcats.skillgradedescription as yinbiaocategory','mathskillcats.created_at'));
    	// $mathskillcats = Yinbiao::select(array('mathskillcats.id', 'mathskillcats.name', 'mathskillcats.yinbiaocategory_id as yinbiaocategory','mathskillcats.mp3', 'mathskillcats.created_at'));
    	return Datatables::of($mathskillcats)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/mathskillcat/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/mathskillcat/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
        // $mathskillcats = Mathskillcat::select(array('mathskillcats.id', 'mathskillcats.skillgradetitle', 'mathskillcats.skillgradedescription as yinbiaocategory', 'mathskillcats.created_at'));
        // return Datatables::of($mathskillcats)
        // ->remove_column('id')

        // ->make();
    }

}
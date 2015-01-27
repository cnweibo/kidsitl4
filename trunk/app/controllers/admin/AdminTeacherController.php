<?php

class AdminTeacherController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "教师管理";
		return View::make('admin.teachers.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return Response::json(['resp' => ['data' => Teacher::all()->toArray()],'code'=>0],200); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建年级";
		// feed the html partial template to angular 
		return View::make('admin.grades.create',compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
	    $teacher = new Teacher;
	    $teacher->name = Input::get('name');
	    $teacher->email = Input::get('email');
	    $teacher->cell = Input::get('cell');
	    $teacher->address = Input::get('address');
	    $teacher->sysloginname = Input::get('sysloginname');
	    $teacher->password = Input::get('password');
	    $teacher->organization = Input::get('organization');

	    try {
		    $teacher->save();	   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $teacher->skillgradetitle . '所需唯一参数已存在！']], 200);
	    		}	
	    		return Response::json(['resp' => ['code' => 410, 'message' => $teacher->skillgradetitle . '创建出错！']], 200);

	    }
	   	return Response::json(['resp' => ['code' => 0, 'message' => $teacher->skillgradetitle . '创建成功！']], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Teacher::find($id);
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
		$title = "年级编辑";
		$teacher = Teacher::findOrFail($id);
		$gradeids = DB::table('grades')->orderBy('id')->lists('id');
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
		return View::make('admin/api/grades/edit',compact('teacher','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $newteacher = Teacher::find($id);
	    if (!$newteacher){
	    	return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
	    }
	    $newteacher->name = Input::get('name');
	    $newteacher->email = Input::get('email');
	    $newteacher->cell = Input::get('cell');
	    $newteacher->address = Input::get('address');
	    $newteacher->sysloginname = Input::get('sysloginname');
	    $newteacher->password = Input::get('password');
	    $newteacher->organization = Input::get('organization');
	    try {
		    $newteacher->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $newteacher->name . '所需唯一参数已存在！']], 200);
	    		}	
	    	return Response::json(['resp' => ['code' => 410, 'message' => $newteacher->name . '更新出错！']], 200);

	    }

		return Response::json(['resp' => ['code' => 0 , 'message' => $newteacher->name . "更新成功！"]], 200);
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
		$title = "删除年级";
		$teacher = Teacher::find($id);
		return View::make('admin/api/grades/delete',compact('title','teacher'));
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
		$teacher = Teacher::find($id);
		if(!$teacher){
			return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
		}
		$teacher->delete();
		return Response::json(['resp' => ['code' => 0 , 'message' => $teacher->name . "删除成功！"]], 200);
	}

	/**
     * Show a list of all the data formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$grades = Teacher::select(array('grades.id', 'grades.skillgradetitle', 'grades.skillgradedescription as yinbiaocategory','grades.created_at'));
    	// $grades = Yinbiao::select(array('grades.id', 'grades.name', 'grades.yinbiaocategory_id as yinbiaocategory','grades.mp3', 'grades.created_at'));
    	return Datatables::of($grades)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/teacher/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/teacher/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
    }

}
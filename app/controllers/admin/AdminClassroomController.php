<?php

class AdminClassroomController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "班级管理";
		return View::make('admin.classrooms.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Classroom::with('owner','students')->get(['sysname','teacher_id'])->toArray();
		// dd(DB::getQueryLog());
			return Response::json(['resp' => ['data' => Classroom::with('owner','students')->get(['id','sysname','teacher_id','description','profileURL','created_at'])->toArray()],'code'=>0],200); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建班级";
		// feed the html partial template to angular 
		return View::make('admin.classrooms.create',compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
	    $classroom = new Classroom;
	    $classroom->sysname = Input::get('sysname');
	    $classroom->description = Input::get('description');
	    $classroom->teacher_id = Input::get('teacher_id');
	    $classroom->profileURL = Input::get('profileURL');

	    try {
		    $classroom->save();	  
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $e->getMessage()]], 200);
	    		}
	    	return Response::json(['resp' => ['code' => 410, 'message' => $e->getMessage()]], 200);

	    }
	    return Response::json(['resp' => ['code' => 0, 'message' => $classroom->sysname . '创建成功！']], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Classroom::find($id);
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
		$title = "班级编辑";
		$classroom = Classroom::findOrFail($id);
		$gradeids = DB::table('classrooms')->orderBy('id')->lists('id');
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
		return View::make('admin/api/classrooms/edit',compact('classroom','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $newclassroom = Classroom::find($id);
	    if (!$newclassroom){
	    	return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
	    }
	    if(Input::get('sysname')) {$newclassroom->sysname = Input::get('sysname') ;}
	    if(Input::get('description')) {$newclassroom->description = Input::get('description');}
	    if(Input::get('teacher_id')) {$newclassroom->teacher_id = Input::get('teacher_id');}
	    if(Input::get('profileURL')) {$newclassroom->profileURL =Input::get('profileURL');}
	    try {
		    $newclassroom->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $newclassroom->sysname . $e->getMessage()]], 200);
	    		}	
	    	return Response::json(['resp' => ['code' => 409, 'message' => $newclassroom->sysname . '所需唯一参数已存在！']], 200);

	    }

		return Response::json(['resp' => ['code' => 0 , 'message' => $newclassroom->sysname . "(" .$newclassroom->teacher_id .")更新成功！"]], 200);
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
		$title = "删除班级";
		$classroom = Classroom::find($id);
		return View::make('admin/api/classrooms/delete',compact('title','classroom'));
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
		$classroom = Classroom::find($id);
		if(!$classroom){
			return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
		}
		$classroom->delete();
		return Response::json(['resp' => ['code' => 0 , 'message' => $classroom->sysname . "删除成功！"]], 200);
	}

	/**
     * Show a list of all the data formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$classrooms = Classroom::select(array('classrooms.id', 'classrooms.skillgradetitle', 'classrooms.skillgradedescription as yinbiaocategory','classrooms.created_at'));
    	// $classrooms = Yinbiao::select(array('classrooms.id', 'classrooms.name', 'classrooms.yinbiaocategory_id as yinbiaocategory','classrooms.mp3', 'classrooms.created_at'));
    	return Datatables::of($classrooms)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/classroom/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/classroom/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
        // $classrooms = Classroom::select(array('classrooms.id', 'classrooms.skillgradetitle', 'classrooms.skillgradedescription as yinbiaocategory', 'classrooms.created_at'));
        // return Datatables::of($classrooms)
        // ->remove_column('id')

        // ->make();
    }

}
<?php

class AdminStudentController extends \BaseController {
	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "学生管理";
		return View::make('admin.students.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return Response::json(['resp' => ['data' => Student::all()->toArray()],'code'=>0],200); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建学生";
		// feed the html partial template to angular 
		return View::make('admin.students.create',compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
	    $student = new Student;
	    $student->name = Input::get('name');
	    $student->email = Input::get('email');
	    $student->xuehao = Input::get('xuehao');
	    $student->cell = Input::get('cell');
	    $student->password = Input::get('password');
	    $student->classroom_id = Input::get('classroom_id');
	    $student->sysloginname = Input::get('sysloginname');

	    try {
		    $student->save();	  
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    		return Response::json(['resp' => ['code' => 409, 'message' => $student->name . '所需唯一参数已存在！']], 200);
			}
			return Response::json(['resp' => ['code' => 410, 'message' => $student->name . '创建出错！']], 200);
	    }
	    return Response::json(['resp' => ['code' => 0, 'message' => $student->name . '创建成功！']], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Student::find($id);
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
		$title = "学生编辑";
		$student = Student::findOrFail($id);
		$gradeids = DB::table('students')->orderBy('id')->lists('id');
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
		return View::make('admin/api/students/edit',compact('student','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $newstudent = Student::find($id);
		if (!$newstudent){
			return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
		}
	    $newstudent->name = Input::get('name');
	    $newstudent->email = Input::get('email');
	    $newstudent->xuehao = Input::get('xuehao');
	    $newstudent->cell = Input::get('cell');
	    $newstudent->password = Input::get('password');
	    $newstudent->classroom_id = Input::get('classroom_id');

	    $newstudent->sysloginname = Input::get('sysloginname');
	    try {
		    $newstudent->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			return Response::json(['resp' => ['code' => 409, 'message' => $newstudent->name . '所需唯一参数已存在！']], 200);
	    		}	
	    	return Response::json(['resp' => ['code' => 409, 'message' => $newstudent->name . '所需唯一参数已存在！']], 200);
	    }

		return Response::json(['resp' => ['code' => 0 , 'message' => $newstudent->name . "更新成功！"]], 200);
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
		$title = "删除学生";
		$student = Student::find($id);
		return View::make('admin/api/students/delete',compact('title','student'));
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
		$student = Student::find($id);
		if(!$student){
			return Response::json(['resp' => ['code' => 400, 'message' => '未找到id为' . $id .'的资源']], 404);
		}
		$student->delete();
		return Response::json(['resp' => ['code' => 0 , 'message' => $student->name . "删除成功！"]], 200);
	}

	/**
     * Show a list of all the data formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$students = Student::select(array('students.id', 'students.skillgradetitle', 'students.skillgradedescription as yinbiaocategory','students.created_at'));
    	// $students = Yinbiao::select(array('students.id', 'students.name', 'students.yinbiaocategory_id as yinbiaocategory','students.mp3', 'students.created_at'));
    	return Datatables::of($students)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/student/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/student/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
        // $students = Student::select(array('students.id', 'students.skillgradetitle', 'students.skillgradedescription as yinbiaocategory', 'students.created_at'));
        // return Datatables::of($students)
        // ->remove_column('id')

        // ->make();
    }
}
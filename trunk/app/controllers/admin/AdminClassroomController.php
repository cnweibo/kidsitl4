<?php

class AdminClassroomController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		$title = "教室管理";
		return View::make('admin.classrooms.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return Classroom::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "创建教室";
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
		// Log::info("store request  \r\n",Input::all());
		// return 'hit he route';

		// $title = "创建教室";
		$errorinfo="ok";
	    $classroom = new Classroom;
	    $classroom->sysname = Input::get('sysname');
	    $classroom->description = Input::get('description');
	    $classroom->teacher_id = Input::get('teacher_id');
	    $classroom->profileURL = Input::get('profileURL');

	    try {
		    $classroom->save();	  
		    dd("saved");  	
	    } catch (Exception $e) {
	    	// dd("error");
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			$errorinfo = "$classroom->skillgradetitle 教室已经存在！";
	    		}	
	    		dd("已经存在!");
	    	dd(get_class_methods('Exception'));
		    return Redirect::to('admin/system/classroom/create')->with('error', $errorinfo);

	    }
	    dd($errorinfo);
	    return Redirect::to('admin/api/system/classroom/create')->with('success', Lang::get('admin/blogs/messages.create.success'));
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
		$title = "教室编辑";
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
		$errorinfo = "ok";
	    $newclassroom = Classroom::findOrFail($id);
	    $newclassroom->sysname = Input::get('sysname');
	    $newclassroom->description = Input::get('description');
	    $newclassroom->teacher_id = Input::get('teacher_id');
	    $newclassroom->profileURL = Input::get('profileURL');
	    try {
		    $newclassroom->save();   	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			$errorinfo = "$newclassroom->email email已经存在！";
	    		}	
	    	dd($errorinfo);

	    }

		return "update success for $newclassroom->email!";
		// return Redirect::to('admin/api/system/classroom/'.$newclassroom->id.'/edit')->with('success', "修改成功！");
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
		$title = "删除教室";
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
		$classroom = Classroom::findOrFail($id);
		$classroom->delete();
		return 'delete ok';
		// return Redirect::to('admin/api/system/classroom');
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
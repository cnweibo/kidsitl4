<?php

class AdminGradesController extends \BaseController {

	/**
	 * Display the index frontend page for angular
	 *
	 * @return Response
	 */
	public function indexpage()
	{
		Log::info('indexpage hit');
		$title = "年级管理";
		return View::make('admin.grades.index',compact('title'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return Grade::all();
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
		// Log::info("store request  \r\n",Input::all());
		// return 'hit he route';

		// $title = "创建年级";
	    $grade = new Grade;
	    $grade->skillgradetitle = Input::get('skillgradetitle');
	    $grade->skillgradedescription = Input::get('skillgradedescription');
	    try {
		    $grade->save();	    	
	    } catch (Exception $e) {
	    	$errorcode = $e->getCode();
	    	if ($errorcode==23000) {
	    			$errorinfo = "$grade->skillgradetitle 年级已经存在！";
	    		}	
	    	// dd($errorinfo);
		    return Redirect::to('admin/system/grade/create')->with('error', $errorinfo);

	    }
	    return Redirect::to('admin/api/system/grade/create')->with('success', Lang::get('admin/blogs/messages.create.success'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Grade::find($id);
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
		$grade = Grade::findOrFail($id);
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
		return View::make('admin/api/grades/edit',compact('grade','title','previousid','nextid','totoalids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$newgrade = Grade::find($id)->first();
		$newgrade->skillgradetitle = Input::get('skillgradetitle');
		$newgrade->skillgradedescription = Input::get('skillgradedescription');
		$newgrade->save();
		return Redirect::to('admin/api/system/grade/'.$newgrade->id.'/edit')->with('success', "修改成功！");
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
		$grade = Grade::find($id);
		return View::make('admin/api/grades/delete',compact('title','grade'));
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
		$grade = Grade::findOrFail($id);
		$grade->delete();
		return 'delete ok';
		// return Redirect::to('admin/api/system/grade');
	}

	/**
     * Show a list of all the data formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    	$grades = Grade::select(array('grades.id', 'grades.skillgradetitle', 'grades.skillgradedescription as yinbiaocategory','grades.created_at'));
    	// $grades = Yinbiao::select(array('grades.id', 'grades.name', 'grades.yinbiaocategory_id as yinbiaocategory','grades.mp3', 'grades.created_at'));
    	return Datatables::of($grades)
    	
    	// ->edit_column('yinbiaocategory', '<a href="{{URL::to(\'admin/yinbiaocategory\')}}">{{($yinbiaocategory)?Yinbiaocategory::find($yinbiaocategory)->ybcategory:""}}</a>')

    	->add_column('actions', '<a href="{{{ URL::to(\'admin/system/grade/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
    	        <a href="{{{ URL::to(\'admin/system/grade/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
    	    ')

    	->make();
        // $grades = Grade::select(array('grades.id', 'grades.skillgradetitle', 'grades.skillgradedescription as yinbiaocategory', 'grades.created_at'));
        // return Datatables::of($grades)
        // ->remove_column('id')

        // ->make();
    }

}
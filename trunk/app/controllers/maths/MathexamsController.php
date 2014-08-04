<?php

class MathexamsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($examid)
	{

		$mathexamExerciseIDs = Mathexam::findOrFail($examid)->exerciseids;
		// dd(($mathexamExerciseIDs));
		$examIDs = json_decode($mathexamExerciseIDs);
		// 注意使用DB::raw带 FIELD(id, examIDs)将会取消默认的按照value排序的方式
		$exercises = Mathsum4::whereIn('id', $examIDs)->orderBy(DB::raw("FIELD(id,".implode(",", $examIDs).")"))->get()->toArray();
		// dd($exercises);

		// $exercises = Mathsum4::whereIn('id',json_decode($mathexamExerciseIDs))->get()->toArray();
		// dd($exercises);
		// dd($mathexam);
		// $difficulty = Input::get('difficulty')? Input::get('difficulty') : 4;
		// $quantity = Input::get('quantity')? Input::get('quantity'): 100;
		// $exercises = [];
		// $exam = [];
		// $exercises = Mathsum4::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();

		// // dd($exercises);
		// //保存卷子到数据库mathexams
		// for ($i=0;$i<$quantity;$i++){
		// 	array_push($exam,$exercises[$i]['id']);
		// }	
		// $exam_exercisesrows= json_encode($exam);
		// $mathexam = new Mathexam;
		// $mathexam-> exerciseids = $exam_exercisesrows;
		// $mathexam-> exercisetab = "mathsum4exercises";				
		// $mathexam->save();
		// $mathexamID = $mathexam -> id ;	
		return View::make('site.mathexercise.examshow',compact('exercises','examid'));




	}
}

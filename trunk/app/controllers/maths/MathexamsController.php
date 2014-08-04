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
		// dd(json_decode($mathexam));
		$exercises = Mathsum4::whereIn('id',json_decode($mathexamExerciseIDs))->get()->toArray();
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

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
	/**
	 * show form to create exam on request
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('site.mathexercise.examcreate');
	}

	/**
	 * api for create exam on request
	 *
	 * @return Response
	 */
	public function create()
	{
		// return View::make('site.mathexercise.examcreate');
		$digitnumbers = Input::get('mathDigitNumbers')? Input::get('mathDigitNumbers') : 4;
		$category = Input::get('mathCategory')? Input::get('mathCategory') : 'plus'; 
		$difficulty = Input::get('mathDifficulty')? Input::get('mathDifficulty') : 4;
		$quantity = Input::get('mathQuantity')? Input::get('mathQuantity'): 100;
		$exercises = [];
		$exam=[];
		$examdata = [];
		$exercises = Mathsum4::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
		//保存卷子题目字典信息到试卷数据库mathexams
		for ($i=0;$i<$quantity;$i++){
			array_push($examdata,$exercises[$i]['id']);
		}	
		$exam_exercisesrows= json_encode($examdata);
		$mathexam = new Mathexam;
		$mathexam-> exerciseids = $exam_exercisesrows;
		$mathexam-> exercisetab = "mathsum4exercises";				
		$mathexam->save();
		$mathexamID = $mathexam -> id ;	
		$exam["examID"] = $mathexamID;
		$exam["examCreatedate"] = date('m/d/Y h:i:s a', time());
		$exam["examdata"] = $exercises;
		return $exam;
		// return View::make('site.mathexercise.mathsum4',compact('exercises','mathexamID'));
	}
}

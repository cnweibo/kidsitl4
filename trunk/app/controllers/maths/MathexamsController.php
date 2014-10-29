<?php

class MathexamsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($examid)
	{
		$mathexam = Mathexam::findOrFail($examid);

		$mathexamExerciseIDs = $mathexam->exerciseids;
		$tablename = $mathexam->exercisetab;
		$examcreatedat = $mathexam->created_at;
		switch ($tablename) {
			case 'mathsum4exercises':
				$exerciseModel = 'Mathsum4';
				break;
			case 'mathsum2exercises':
				$exerciseModel = 'Mathsum2';
				break;
			case 'mathsum1exercises':
				$exerciseModel = 'Mathsum1';
				break;	
			case 'mathsum3exercises':
				$exerciseModel = 'Mathsum3';
				break;	
			case 'mathmultiply2exercises':
				$exerciseModel = 'Mathmultiply2';
			default:
				break;
		}
		// dd(($mathexamExerciseIDs));
		$examIDs = json_decode($mathexamExerciseIDs);
		// 注意使用DB::raw带 FIELD(id, examIDs)将会取消默认的按照value排序的方式
		$exercises = $exerciseModel::whereIn('id', $examIDs)->orderBy(DB::raw("FIELD(id,".implode(",", $examIDs).")"))->get()->toArray();
		
		return View::make('site.mathexercise.examshow',compact('exercises','examid','examcreatedat'));




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
		$mathexam = new Mathexam;
		// return View::make('site.mathexercise.examcreate');
		$digitnumbers = Input::get('mathDigitNumbers')? Input::get('mathDigitNumbers') : 4;
		$category = Input::get('mathCategory')? Input::get('mathCategory') : 'plus'; 
		$difficulty = Input::get('mathDifficulty')? Input::get('mathDifficulty') : 4;
		$quantity = Input::get('mathQuantity')? Input::get('mathQuantity'): 100;
		$exercises = [];
		$exam=[];
		$examdata = [];
		if ($category == 'plus') {
			switch ($digitnumbers) {
				case '4':
					$mathexam-> exercisetab = "mathsum4exercises";
					$exercises = Mathsum4::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
					//保存卷子题目字典信息到试卷数据库mathexams
					for ($i=0;$i<$quantity;$i++){
						array_push($examdata,$exercises[$i]['id']);
					}	
					break;
				case '2':
					$mathexam-> exercisetab = "mathsum2exercises";
					$exercises = Mathsum2::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
					//保存卷子题目字典信息到试卷数据库mathexams
					for ($i=0;$i<$quantity;$i++){
						array_push($examdata,$exercises[$i]['id']);
					}	
					break;
				case '1':
					$mathexam-> exercisetab = "mathsum1exercises";
					$exercises = Mathsum1::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
					//保存卷子题目字典信息到试卷数据库mathexams
					for ($i=0;$i<$quantity;$i++){
						array_push($examdata,$exercises[$i]['id']);
					}	
					break;	
				default:
					break;
			}
		}else if ($category == 'times'){
			switch ($digitnumbers) {
				case '2':
					$mathexam-> exercisetab = "mathmultiply2exercises";
					$exercises = Mathmultiply2::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
					//保存卷子题目字典信息到试卷数据库mathexams
					for ($i=0;$i<$quantity;$i++){
						array_push($examdata,$exercises[$i]['id']);
					}	
					break;
			
				default:
					break;
			}
		}
		$exam_exercisesrows= json_encode($examdata);
		$mathexam-> exerciseids = $exam_exercisesrows;
		$mathexam->save();
		$mathexamID = $mathexam -> id ;	
		$exam["examID"] = $mathexamID;
		$exam["examCreatedate"] = date('m/d/Y h:i:s a', time());
		$exam["examdata"] = $exercises;
		return $exam;
		// return View::make('site.mathexercise.mathsum4',compact('exercises','mathexamID'));
	}
}

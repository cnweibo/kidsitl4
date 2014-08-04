<?php

class Mathsum4Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index4()
	{

		
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(1000,9999);
			$operand2 = rand(1000,9999);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 4;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index31()
	{

		
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(100,999);
			$operand2 = rand(1000,9999);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 3;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index32()
	{

		
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(1000,9999);
			$operand2 = rand(100,999);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 3;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index21()
	{

		
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(10,99);
			$operand2 = rand(1000,9999);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 2;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index22()
	{
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(1000,9999);
			$operand2 = rand(10,99);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 2;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index11()
	{
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(1,9);
			$operand2 = rand(1000,9999);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 1;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index12()
	{
		for ($i=0;$i<1000;$i++){
			$Mathsum4row = new Mathsum4;
			$operand1 = rand(1000,9999);
			$operand2 = rand(1,9);
			$Mathsum4row->operand1 = $operand1;
			$Mathsum4row->operand2 = $operand2;
			$Mathsum4row->sumdata = $operand1+$operand2;
			$Mathsum4row->difficulty = 1;
			try {
			    $Mathsum4row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}

	public function exercise4(){
		$difficulty = Input::get('difficulty')? Input::get('difficulty') : 4;
		$quantity = Input::get('quantity')? Input::get('quantity'): 100;
		$exercises = [];
		$exam = [];
		$exercises = Mathsum4::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
		//保存卷子题目字典信息到试卷数据库mathexams
		for ($i=0;$i<$quantity;$i++){
			array_push($exam,$exercises[$i]['id']);
		}	
		$exam_exercisesrows= json_encode($exam);
		$mathexam = new Mathexam;
		$mathexam-> exerciseids = $exam_exercisesrows;
		$mathexam-> exercisetab = "mathsum4exercises";				
		$mathexam->save();
		$mathexamID = $mathexam -> id ;	
		return View::make('site.mathexercise.mathsum4',compact('exercises','mathexamID'));

	}
}

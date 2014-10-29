<?php

class Mathmultiply2Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index4()
	{

		
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1000,9999);
			$operand2 = rand(1000,9999);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 4;
			try {
			    $Mathmultiply2row->save();
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
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(100,999);
			$operand2 = rand(1000,9999);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 3;
			try {
			    $Mathmultiply2row->save();
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
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1000,9999);
			$operand2 = rand(100,999);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 3;
			try {
			    $Mathmultiply2row->save();
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
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(10,99);
			$operand2 = rand(1000,9999);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 2;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index22()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1000,9999);
			$operand2 = rand(10,99);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 2;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index11()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1,9);
			$operand2 = rand(1000,9999);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 1;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	public function index12()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1000,9999);
			$operand2 = rand(1,9);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 1;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	// 2位数题库populate
	// difficulty = 1 digitnumber = 2
	public function index2_12()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(1,9);
			$operand2 = rand(10,99);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 1;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}

	public function index2_21()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(10,99);
			$operand2 = rand(1,9);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 1;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	// difficulty =2 digitnumber =2
	public function index2_22()
	{
		for ($i=0;$i<1000;$i++){
			$Mathmultiply2row = new Mathmultiply2;
			$operand1 = rand(10,99);
			$operand2 = rand(10,99);
			$invisualcolumns = rand(1,3);
			$Mathmultiply2row->invisualcolumns = $invisualcolumns;
			$Mathmultiply2row->operand1 = $operand1;
			$Mathmultiply2row->operand2 = $operand2;
			$Mathmultiply2row->multiplydata = $operand1*$operand2;
			$Mathmultiply2row->difficulty = 2;
			try {
			    $Mathmultiply2row->save();
			} catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
		return "done!";
	}
	// 1位数题库populate
	// difficulty = 1 digitnumber = 1
	public function index1_11()
	{
		for ($i=0;$i<100;$i++){
			$Mathsum1row = new Mathsum1;
			$operand1 = rand(0,9);
			$operand2 = rand(0,9);
			$invisualcolumns = rand(1,3);
			$Mathsum1row->invisualcolumns = $invisualcolumns;
			$Mathsum1row->operand1 = $operand1;
			$Mathsum1row->operand2 = $operand2;
			$Mathsum1row->multiplydata = $operand1*$operand2;
			$Mathsum1row->difficulty = 1;
			try {
			    $Mathsum1row->save();
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
		$exercises = Mathmultiply2::orderByRaw("rand() limit 0,{$quantity}")->get()->toArray();
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

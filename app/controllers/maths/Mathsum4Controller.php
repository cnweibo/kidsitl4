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

	public function exercise4($difficulty = 4){

		$exercises = [];
		$exercises = Mathsum4::orderByRaw("rand() limit 0,50")->get()->toArray();
		// dd($exercises);
		//保存卷子到数据库
		// for ($i=0;$i<100;$i++){
		// 	$exercise = Mathsum4::find(rand(1,10000));
		// 	array_push($exercises,$exercise);
		// }	
		return View::make('site.mathexercise.mathsum4',compact('exercises'));

	}
}

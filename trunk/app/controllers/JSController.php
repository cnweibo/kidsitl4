<?php

class JSController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$fayinguizeid = Input::get('fayinguizeid');
		$yinbiaoid = Input::get('yinbiaoid');
		return Response::make(View::make('getjs.guestaddjs',compact('fayinguizeid','yinbiaoid')), 200, array('Content-Type' => 'text/javascript'));
		// echo 'angular.module(\'guestaddwordapp\', []).controller(\'guestaddwordController\', function($scope,$window,$log,$http){';
		// echo '$scope.csrf_token = $window.csrf_token;';
		// 	echo '$http.get(\'/guestaddedword\').success(function(guestaddedwords);';
		// 	echo '{';
		// 	echo '$scope.wordsadded = guestaddedwords;';
		// 	echo '});';
		// 	echo '$scope.addword = function(){';
		// 	echo 'var wordadded = {';
		// 		echo 'wordtext: $scope.newwordadded,';
		// 		echo '_token: $scope.csrf_token,';
		// 		echo 'createdby: \'zhangsan\' ';
		// 		echo '};';
		// 		echo ' $http.post(\'/guestaddedword\',wordadded);';
		// 		echo '$scope.wordsadded.push({';
		// 		echo 'wordtext: $scope.newwordadded,';
		// 		echo 'createdby:\'wangwu\' ';
		// 		echo '});';
		// 		// $log.info($scope.wordsadded);
		// 		echo '$scope.newwordadded = \'\'; ';
		// 	echo '};';

		// echo '});';
	}


}

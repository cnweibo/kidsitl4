@extends('admin.layouts.default')
@section('title')
	{{{ $title }}} |@parent
@stop
@section('keywords')
	{{-- expr --}}
@stop
@section('author')
	{{-- expr --}}
@stop
@section('description')
	{{-- expr --}}
@stop
@section('css')
	<link rel="stylesheet" href="{{asset('htmlapp/libs/angular-xeditable-0.1.8/css/xeditable.css')}}">
	<link rel="stylesheet" href="{{asset('htmlapp/libs/angular-toastr/dist/angular-toastr.css')}}">
	<link rel="stylesheet" href="{{asset('htmlapp/assets/custom.css')}}">
@stop
@section('content')

	<div class="container" ng-app="classroomApp" ng-controller="containerCtrl">
		@include('admin.partials.indicatorcontainer')
		
		<div class="page-header">
			<h3>
				{{{ $title }}}

				<div class="pull-right">
					<a href="#/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 新增班级</a>
				</div>
			</h3>
		</div>
		<div ng-view></div> <!-- web app view -->
		
	</div>
@stop

{{-- Scripts --}}
@section('scripts')
	@include('admin.partials.csrf_token')
	<script type="text/javascript">

	</script>
	<!--(if target mathdev)><!-->
	<script type="text/javascript" src="{{asset('htmlapp/libs/jquery/dist/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/underscore/underscore.js')}}"></script>


	<script type="text/javascript" src="{{asset('htmlapp/libs/angular/angular.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-route/angular-route.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-animate/angular-animate.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/ui-utils-0.2.1/ui-utils.js')}}"></script>

	
	
    <script type="text/javascript" src="{{ asset('htmlapp/libs/angular-busy/dist/angular-busy.js') }}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-toastr/dist/angular-toastr.js')}}"></script>	


	<script type="text/javascript" src="{{asset('htmlapp/system/classroom/classroomApp.mod.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/system/container.ctrl.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/syscommon/khttp.srv.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/system/classroom/classroomList.ctrl.js')}}"></script>
	 <script type="text/javascript" src="{{asset('htmlapp/system/classroom/classroomCreate.ctrl.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-xeditable-0.1.8/js/xeditable.js')}}"></script>

	
<!--<!(endif)-->
<!--(if target mathrelease)><!-->
<!-- <script type="text/javascript" src="{{asset('dist/appTeacher.min.js')}}"></script>-->
<!--<!(endif)-->
@stop

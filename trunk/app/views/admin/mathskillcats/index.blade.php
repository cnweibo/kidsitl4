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
	<link rel="stylesheet" href="{{ asset('htmlapp/libs/angular-busy/angular-busy.css') }}">
	<link rel="stylesheet" href="{{asset('htmlapp/assets/custom.css')}}">
@stop
@section('content')

	<div class="container" ng-app="mathskillcatApp" ng-controller="containerCtrl">
		@include('admin.partials.indicatorcontainer')
		
		<div class="page-header">
			<h3>
				{{{ $title }}}

				<div class="pull-right">
					<a href="#/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 新增数学知识点</a>
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
	<!-- pre angular js files -->
	<script type="text/javascript" src="{{asset('htmlapp/libs/jquery/dist/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/underscore/underscore.js')}}"></script>


	<script type="text/javascript" src="{{asset('htmlapp/libs/angular/angular.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-route/angular-route.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-animate/angular-animate.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-messages/angular-messages.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/ui-utils-0.2.1/ui-utils.js')}}"></script>
	<!-- introduce sync/async form validate mechanism -->
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-validate-directive/validate.js')}}" ></script>

	
    <script type="text/javascript" src="{{ asset('htmlapp/libs/angular-busy/dist/angular-busy.js') }}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-toastr/dist/angular-toastr.js')}}"></script>	
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-bootstrap/ui-bootstrap-tpls.js')}}"></script>	
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-filter/dist/angular-filter.js')}}"></script>	

	<script type="text/javascript" src="{{asset('htmlapp/math/skillcat/mathskillcatApp.mod.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/system/container.ctrl.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/syscommon/khttp.srv.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/syscommon/simplevalidate.srv.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/syscommon/parsers.srv.js')}}"></script>


	<script type="text/javascript" src="{{asset('htmlapp/math/skillcat/mathskillcatList.ctrl.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/math/skillcat/mathskillcatCreate.ctrl.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-xeditable-0.1.8/js/xeditable.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/libs/custom.js')}}"></script>


	
<!--<!(endif)-->
<!--(if target mathrelease)><!-->
<!-- <script type="text/javascript" src="{{asset('dist/appTeacher.min.js')}}"></script>-->
<!--<!(endif)-->
@stop

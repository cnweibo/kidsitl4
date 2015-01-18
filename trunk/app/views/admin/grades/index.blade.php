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
@section('content')

	<div class="container" ng-app="gradeApp">
		<div cg-busy="currentPromise" style="position:absolute;top:50%;left:50%" ></div>
		<div class="page-header">
			<h3>
				{{{ $title }}}

				<div class="pull-right">
					<a href="#/create" class="btn btn-primary">新增</a>
					<a href="#/grade-list" class="btn btn-primary">列表展示</a>
					<a href="#grade-list/1" class="btn btn-primary">单个展示</a>
					<!-- <a href="{{{ URL::to('admin/system/grade/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> 新增年级</a>  -->
				</div>
			</h3>
		</div>
		<div ng-view></div> <!-- web app view -->
		
	</div>
@stop

{{-- Scripts --}}
@section('scripts')
	<!--(if target mathdev)><!-->
	<script type="text/javascript" src="{{asset('htmlapp/libs/jquery/dist/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular/angular.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/angular-route/angular-route.js')}}"></script>

	
    <script type="text/javascript" src="{{ asset('htmlapp/libs/angular-busy/dist/angular-busy.js') }}"></script>


	<script type="text/javascript" src="{{asset('htmlapp/system/grade/gradeApp.mod.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/system/grade/gradeList.ctrl.js')}}"></script>

	<script type="text/javascript" src="{{asset('htmlapp/syscommon/khttp.srv.js')}}"></script>
	
<!--<!(endif)-->
<!--(if target mathrelease)><!-->
<!-- <script type="text/javascript" src="{{asset('dist/appGrade.min.js')}}"></script>-->
<!--<!(endif)-->
@stop
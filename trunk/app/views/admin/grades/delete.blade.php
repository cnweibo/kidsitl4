@extends('admin.layouts.modal')
@section('content')
	{{Form::open(['id'=>'deleteForm','class'=>'Form-horizontal','method'=>'delete','action'=>['AdminGradesController@destroy', $grade->id]])}}
	{{Form::input('hidden', "_token", csrf_token())}}
	{{Form::input('hidden', "id", $grade->id)}}
	<div class="form-group">
		<div class="controls">
			删除 {{$grade->skillgradetitle}} 的信息？
			<element class="btn-cancel close_popup"><button class="btn btn-primary">取消</button></element>
			<button type="submit" class="btn btn-danger">删除</button>
		</div>
	</div>
	{{Form::close()}}

@stop
@extends('admin.layouts.modal')
@section('content')
	{{ Form::open(['action' => 'AdminGradesController@store']) }}
		<div class="form-group">
			{{ Form::label('skillgradetitle', '年级') }}
			{{ Form::text('skillgradetitle', null, ['class' => 'form-control','autofocus']) }}
		</div>
		<div class="form-group">
			{{ Form::label('skillgradedescription', '详细描述') }}
			{{ Form::text('skillgradedescription', null, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('提交', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}

@stop
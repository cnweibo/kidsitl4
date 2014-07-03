@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
	{{ Form::open()}}
		<div class="form-group">
			{{Form::label('title','发音规则:')}}
			{{Form::text('title',null,['class' =>'form-control'])}}
		</div>   
		<div class="form-group">
			{{Form::label('description','发音规则描述:')}}
			{{Form::text('description',null,['class' =>'form-control'])}}
		</div>  		
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
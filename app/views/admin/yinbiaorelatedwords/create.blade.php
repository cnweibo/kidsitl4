@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	{{ Form::open(['files'=>true])}}
		<div class="form-group">
			{{Form::label('wordtext','单词：')}}
			{{Form::text('wordtext',null,['class' =>'form-control'])}}
		</div>
		
		<div class="form-group">
			{{Form::label('wordyinbiao','单词音标:')}}
			{{Form::text('wordyinbiao',null,['class' =>'form-control'])}}
		</div>   
		<div class="form-group">
			{{Form::label('mp3','单词音标MP3:')}}
			{{Form::file('mp3')}}
		</div> 	
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	{{ Form::open(['files'=>true])}}
		<div class="form-group">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h3 class="panel-title">单词</h3>
				</div>
				<div class="panel-body">
	                {{Form::label('wordtext','单词：')}}
	                {{Form::text('wordtext',null,['class' =>'form-control'])}}
				</div>
		    </div>	
		</div>

		<div class="form-group">
			{{Form::label('wordyinbiao','单词音标:')}}
			{{Form::text('wordyinbiao',null,['class' =>'form-control'])}}
		</div>   
		<div class="form-group">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h3 class="panel-title">MP3</h3>
				</div>
				<div class="panel-body">
					{{Form::label('mp3','单词音标MP3:')}}
					{{Form::file('mp3')}}	                
				</div>
		    </div>
			
		</div> 	
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
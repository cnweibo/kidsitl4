@extends('sandstudy.layouts.master')
@section('content')
	{{ Form::open(['files'=>true])}}

			<div class="form-group">
				{{Form::label('hanzi','汉字：')}}
				{{Form::text('hanzi',null,['class' =>'form-control'])}}
			</div>
			<div class="form-group">
				<!-- <label for="">汉字</label> -->
				<!-- <input type="text" class="form-control" id="" placeholder="Input field"> -->
				<!-- <label for="">笔顺</label> -->
				<!-- <input type="text" class="form-control" id="" placeholder="Input field"> -->
				{{Form::label('relatedwords','相关词：')}}
				{{Form::text('relatedwords',null,['class' =>'form-control'])}}
				<!-- <label for="">文件</label> -->
				<!-- <input type="file" class="form-control" id="" placeholder="Input field"> -->
			</div>   
			<div class="form-group">
				{{Form::label('filename','笔顺flash文件：')}}
				{{Form::file('filename')}}
			</div> 	
			{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
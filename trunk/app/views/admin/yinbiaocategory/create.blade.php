@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	{{ Form::open(['files'=>true])}}
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong></strong> 已经存在下面的音标类别!
		</div>	
			<ul class="list-group">
				@foreach ($yinbiaocats as $yinbiaocat)
					<li class="list-group-item text-info">{{$yinbiaocat->ybcategory}}</li>
				@endforeach			  
			</ul> 
			<div class="form-group">
				{{Form::label('yinbiaocat','音标类别名称：')}}
				{{Form::text('yinbiaocat',null,['class' =>'form-control'])}}
			</div>
			
			<div class="form-group">
				{{Form::label('description','类别描述:')}}
				{{Form::text('description',null,['class' =>'form-control'])}}
			</div>   
			{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
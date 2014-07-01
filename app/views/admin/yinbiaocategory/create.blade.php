@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	{{ Form::open(['files'=>true])}}
			<div class="form-group">
				{{Form::label('yinbiao','音标：')}}
				{{Form::text('yinbiao',null,['class' =>'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::label('yinbiaocategory_id','类别:')}}
				<select size=6 name="yinbiaocategory_id" id="yinbiaocategory_id">
					@foreach (Yinbiaocategory::all() as $yinbiaocat)
						<option value={{$yinbiaocat->id}}>{{$yinbiaocat->ybcategory}}</option>
					@endforeach
				</select>
			</div>  
			<div class="form-group">
				{{Form::label('relatedwords','相关英语词汇:')}}
				{{Form::text('relatedwords',null,['class' =>'form-control'])}}
			</div>   
			<div class="form-group">
				{{Form::label('filename','音标mp3文件：')}}
				{{Form::file('filename')}}
			</div> 	
			{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
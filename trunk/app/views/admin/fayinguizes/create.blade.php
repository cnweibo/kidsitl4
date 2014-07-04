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
		<div class="panel panel-info">
			<div class="panel-heading">
			<h3 class="panel-title">所属音标</h3>
			</div>
			<div class="panel-body">
                <label class="control-label" for="yinbiao_id">所属音标:</label>
				<select size=6 name="yinbiao_id" id="yinbiao_id">
					@foreach (Yinbiao::all() as $yinbiao)
						<option value={{$yinbiao->id}}>{{$yinbiao->name}}</option>
					@endforeach
				</select>
            </div>
	    </div>	  		
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
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
		<!-- fayinguize -->
		<div class="form-group">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">所属规则</h3>
					</div>
					<div class="panel-body">
                        <label class="control-label" for="fayinguize_id">所属规则:</label>
						<select size=6 name="fayinguize_id" id="fayinguize_id">
							@foreach (Fayinguize::all() as $fayinguize)
								<option value={{$fayinguize->id}}>{{$fayinguize->title}}</option>
							@endforeach
							
						</select>
	            </div>
		    </div>
		</div>
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
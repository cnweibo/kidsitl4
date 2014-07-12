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
                        <div class="input-group" style="margin-bottom: 10px">
						      <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
						      <input type="text" class="form-control" id="guizesearch" name="guizesearch" placeholder="search">
					    </div>
                        <label class="control-label" for="fayinguize_id">所属规则:</label -->
						<select multiple size=20 name="fayinguize_id[]" id="fayinguize_id">
							@foreach (Fayinguize::with('yinbiao')->get() as $fayinguize)
								<option value={{$fayinguize->id}}>{{$fayinguize->title}}->{{$fayinguize->yinbiao->name}}</option>
							@endforeach
							
						</select>
						
	            </div>
		    </div>
		</div>
		{{Form::submit('提交',['class' => 'btn btn-primary'])}}
    {{ Form::close()}}
@stop
@section('scripts')
	<script src="{{asset('bootstrap/js/backend.js')}}"></script>
@stop
@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	{{ Form::open(['files'=>true])}}
		<div class="form-group">
			{{Form::label('sentencetext','例句：')}}
            {{Form::text('sentencetext',null,['class' =>'form-control'])}}	
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
		<!-- related words -->
		<div class="form-group">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">所属单词</h3>
					</div>
					<div class="panel-body">
                        <div class="input-group" style="margin-bottom: 10px">
						      <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
						      <input type="text" class="form-control" id="wordsearch" name="wordsearch" placeholder="search">
					    </div>
                        <label class="control-label" for="relatedword_id">所属单词:</label -->
						<select multiple size=6 name="relatedword_id[]" id="relatedword_id">
							@foreach (Relatedword::all() as $relatedword)
								<option @if($relatedword->id == Previousewordid::all()->last()->relatedwordid) selected @endif value={{$relatedword->id}}>{{$relatedword->wordtext}}</option>
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
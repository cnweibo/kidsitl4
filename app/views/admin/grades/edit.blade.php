@extends('admin.layouts.modal')
@section('content')
	{{ Form::open(['action' => array('AdminGradesController@update', $grade->id),'method' => 'PUT']) }}
		<div class="form-group">
			{{ Form::label('skillgradetitle', '年级') }} <a href="{{action('AdminGradesController@index')}}"> <span class="badge">{{$totoalids}}</span></a>
			{{ Form::text('skillgradetitle', $grade->skillgradetitle, ['class' => 'form-control','autofocus']) }}
		</div>
		<div class="form-group">
			{{ Form::label('skillgradedescription', '详细描述') }}
			{{ Form::text('skillgradedescription', $grade->skillgradedescription, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('提交', ['class' => 'btn btn-primary']) }}
		<nav>
		  <ul class="pager">
		    <li><a href="{{action('AdminGradesController@edit', $previousid)}}">Previous</a></li>
		    <li><a href="{{action('AdminGradesController@edit', $nextid)}}">Next</a></li>
		  </ul>
		</nav>
	<hr>
	{{ Form::close() }}
@stop
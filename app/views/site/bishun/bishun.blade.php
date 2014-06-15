@extends('site.layouts.default')
<div class="container">
{{Form::open(['method' =>'POST','url'=>'http://kidsit.cn/bishun'])}}
	<div class="form-group pull-right">
		<label for="">输入汉字查询笔顺</label>
		<input type="text" class="bishunsearch" id="bishunsearch" placeholder="输入要查询的字">
		<button type="submit" class="btn btn-primary">查询</button>
	</div>
{{Form::close()}};	
</div>
{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun.bishunpartial')
@stop
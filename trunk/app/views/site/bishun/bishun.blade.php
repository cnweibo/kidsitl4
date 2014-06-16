@extends('site.layouts.default')
<div class="container">
{{Form::open(['method' =>'POST','url'=>'http://kidsit.cn/bishun','class' => 'form-inline' , 'id' => 'bishunsearchform' ])}}
	<div class="form-group pull-right">
		<label for="bishunsearch">输入汉字查询笔顺: </label>
		<input type="text" name="bishunsearch" id="inputBishunsearch" class="form-control" required="required">
		<!-- <button type="submit" class="btn btn-primary">查询</button> -->
	</div>
{{Form::close()}}	
</div>
{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun.bishunpartial')
@stop
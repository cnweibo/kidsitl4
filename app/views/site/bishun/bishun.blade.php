@extends('site.layouts.default')
@section('contentbishunsearch')
<div class="row"> {{-- Content for bishun flash search form --}}
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<p class="text-primary">1.输入任意您希望查询笔顺的汉字；2.系统自动检索出笔顺flash；3.通过鼠标掠过播放暂停按钮来观察该字的笔顺</p>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		{{Form::open(['method' =>'POST','url'=>'http://kidsit.cn/bishun','class' => 'form-inline' , 'id' => 'bishunsearchform' ])}}
			<div class="form-group pull-right">
				<label for="bishunsearch">输入汉字查询笔顺: </label>
				<input type="text" name="bishunsearch" id="inputBishunsearch" class="form-control" required="required">
				<!-- <button type="submit" class="btn btn-primary">查询</button> -->
			</div>
		{{Form::close()}}	
	</div>
</div>
@stop
{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun.bishunpartial')
@stop
@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/fayinguizes/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> 新增发音规则</a>
			</div>
		</h3>
	</div>
	<div class="panel panel-danger">
			<div class="panel-heading">
			<h3 class="panel-title">建议音标相关信息管理流程图：</h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-lg btn-success" href="http://kidsit.cn/admin/yinbiaocategory">
  				<i class="fa fa-flag fa-2x pull-left"></i> 创建音标类别</a>
				<i class="fa fa-arrow-right fa-3x"></i>
				<a class="btn btn-lg btn-success" href="http://kidsit.cn/admin/yinbiaos">
  				<i class="fa fa-flag fa-2x pull-left"></i> 创建48个音标</a>
				<i class="fa fa-arrow-right fa-3x"></i>
				<a class="btn btn-lg btn-success" href="http://kidsit.cn/admin/fayinguizes">
  				<i class="fa fa-flag fa-2x pull-left"></i> 创建发音规则</a>
				<i class="fa fa-arrow-right fa-3x"></i>
				<a class="btn btn-lg btn-success" href="http://kidsit.cn/admin/yinbiaorelatedwords">
  				<i class="fa fa-flag fa-2x pull-left"></i> 创建例词</a>
				<i class="fa fa-arrow-right fa-3x"></i>
				<a class="btn btn-lg btn-success" href="http://kidsit.cn/admin/yinbiaorelatedwords">
  				<i class="fa fa-flag fa-2x pull-left"></i> 创建例句</a>
			</div>
    </div>
	<table id="fayinguizes" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">ID</th>
				<th class="col-md-2">发音规则：</th>
				<th class="col-md-2">规则描述</th>
				<th class="col-md-1">所属音标</th>
				<th class="col-md-2">正则表达式</th>
				<th class="col-md-2">创建于：</th>
				<th class="col-md-2">操作：</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#fayinguizes').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/fayinguizes/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"99%", height:"98%"});
	     		}
			});
		});
	</script>
@stop
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
		</h3>
	</div>
	@include('admin.partials.yinbiaoprocess')
	<table id="guestaddedwords" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">ID:</th>
				<th class="col-md-2">单词：</th>
				<th class="col-md-2">批准状态：</th>
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
			oTable = $('#guestaddedwords').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/guestaddedwords/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"99%", height:"98%"});
	     		}
			});
		});
	</script>
@stop
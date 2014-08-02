@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

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
				<th class="col-md-1">ID:</th>
				<th class="col-md-1">待审单词</th>
				<th class="col-md-1">所属音标</th>	
				<th class="col-md-1">所属规则</th>	
				<th class="col-md-1">创建于：</th>			
				<th class="col-md-1">批准状态：</th>
				<th class="col-md-2">参考例词</th>
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
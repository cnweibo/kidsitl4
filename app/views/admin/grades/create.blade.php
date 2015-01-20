
<div class="container" ng-controller="gradeCreateCtrl as vm">

		<!-- Notifications -->
				<!-- ./ notifications -->

		<div class="page-header">
			<h3>
				创建年级				<div class="pull-right">
					<button class="btn btn-default btn-small btn-inverse close_popup" ng-click="vm.goBack()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
				</div>
			</h3>
		</div>

		<!-- Content -->
			<form method="POST" action="http://kidsit.cn/admin/api/system/grade" accept-charset="UTF-8"><input name="_token" type="hidden" ng-value={{csrf_token()}} >
				<div class="form-group">
					{{ Form::label('skillgradetitle', '年级') }}
					{{ Form::text('skillgradetitle', null, ['class' => 'form-control','autofocus','ng-model' => 'vm.newGrade.skillgradetitle']) }}
					
				</div>
				<div class="form-group">
					{{ Form::label('skillgradedescription', '详细描述') }}
					{{ Form::text('skillgradedescription', null, ['class' => 'form-control','ng-model' => 'vm.newGrade.skillgradedescription']) }}
				</div>
				{{ Form::button('提交', ['class' => 'btn btn-primary','ng-click'=>'vm.createGrade()']) }}
			{{ Form::close() }}
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
					</footer>
		<!-- ./ Footer -->
		<script type="text/javascript">
			var _token ="{{csrf_token()}}";
		</script>
</div>

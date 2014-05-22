<!DOCTYPE html>
<html lang="zh_CN">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			your title goes here
		</title>
		<meta name="keywords" content="your title goes here" />
		<meta name="author" content="kidsit.cn" />
		<meta name="description" content="your description goes here" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/fonts/font-awesome-4.1.0/css/font-awesome.min.css')}}">   	
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/css/custom.css')}}">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="{{asset('bootstrap/js/html5shiv.js')}}"></script>
		  <script src="{{asset('bootstrap/js/respond.min.js')}}"></script>		  
		<![endif]-->
		
		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>
	<body>	
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>heading1</th>
					<th>heading2</th>
					<th>heading3</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data11</td>
					<td>data12</td>
					<td>data13</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
			</tbody>
		</table>
		<p class="text-info">table-striped+table-bordered</p>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>heading1</th>
					<th>heading2</th>
					<th>heading3</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data11</td>
					<td>data12</td>
					<td>data13</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
			</tbody>
		</table>	
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>table-responsive</strong> following is the table-responsive
		</div>
		<div class="table-responsive">
				<table class="table table-hover">
					<thead>
				<tr>
					<th>heading1</th>
					<th>heading2</th>
					<th>heading3</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data11</td>
					<td>data12</td>
					<td>data13</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
			</tbody>
				</table>
			</div>	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>heading1</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data 1</td>
					<td>data 2</td>
					<td>data 3</td>
				</tr>
				<tr>
					<td>data 1</td>
					<td>data 2</td>
				</tr>
			</tbody>
		</table>
		<p class="text-warning">following is table-condensed</p>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<th>heading1</th>
					<th>heading2</th>
					<th>heading3</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data11</td>
					<td>data12</td>
					<td>data13</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
				<tr>
					<td>data21</td>
					<td>data22</td>
					<td>data23</td>
				</tr>
			</tbody>
		</table>
		<div class="btn-toolbar">
			<div class="btn-group"></div>
			<div class="btn-group"></div>
			<div class="btn-group"></div>
		</div>	
		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>        
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/custom.js')}}"></script>
	</body>
</html>
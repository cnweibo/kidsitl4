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
		<div class="panel panel-warning">
		    <div class="panel-heading">heading lorem  </div>
			<div class="panel-body">
			   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>

		<div class="panel panel-success">
			  <div class="panel-heading">
					<h3 class="panel-title">Panel title</h3>
			  </div>
			  <div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			  </div>
		</div>
		<div class="panel panel-danger">
			<!-- Default panel contents -->
			<div class="panel-heading">Panel heading</div>
				<div class="panel-body">
					<p>Text goes here...</p>
				</div>
		
				<!-- Table -->
				<table class="table">
					<thead>
						<tr>
							<th>Heading 1</th>
						</tr>
						<tr>
							<th>Heading 2</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Content 1</td>
						</tr>
						<tr>
							<td>Content 2</td>
						</tr>
					</tbody>
				</table>
		</div>
		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>        
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/custom.js')}}"></script>
	</body>
</html>	
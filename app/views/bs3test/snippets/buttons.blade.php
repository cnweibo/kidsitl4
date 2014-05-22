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
        <link rel="stylesheet" href="{{asset('bootstrap/css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">

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
		<button type="button" class="btn btn-large btn-block btn-info">button</button>
		<button type="button" class="btn btn-default">button</button>
		<button type="button" class="btn btn-danger">button</button>
		<button type="button" class="btn btn-success">button</button>
		<button type="button" class="btn btn-primary">button</button>
		<button type="button" class="btn btn-primary disabled">button</button>
		<button type="button" class="btn btn-lg btn-info">button</button>
		<button type="button" class="btn btn-sm btn-info">button</button>
		<button type="button" class="btn btn-xs btn-danger">button</button>
		<button type="button" class="btn btn-md btn-danger">button</button>
		<button type="button" class="btn btn-large btn-block btn-info">button</button>
		<button type="button" class="btn btn-large btn-block btn-danger">button</button>
		<button type="button" class="btn btn-large btn-block btn-lg btn-warning">button</button>
		<button type="button" class="btn btn-large btn-block btn-sm btn-success">button</button>
		<button type="button" class="btn btn-large btn-block btn-xs btn-default">button</button>
		<button type="button" class="btn btn-large btn-block btn-primary">button</button>
        <div class="btn-group btn-group-lg">
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-left"></i> Left</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-center"></i> Center</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-right"></i> Right</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-justify"></i> Justify</button>
        </div>
        <div class="btn-group btn-group-xs">
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-left"></i> Left</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-center"></i> Center</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-right"></i> Right</button>
        	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-justify"></i> Justify</button>
        </div>
        <div class="btn-group-vertical">
        	<button type="button" class="btn btn-default">Top</button>
        	<button type="button" class="btn btn-default">Middle</button>
        	<button type="button" class="btn btn-default">Bottom</button>
        </div>
        <div class="btn-group-vertical">
        	<button type="button" class="btn btn-lg btn-danger">Top</button>
        	<button type="button" class="btn btn-lg btn-primary">Middle</button>
        	<button type="button" class="btn btn-lg btn-default">Bottom</button>
        </div>  
		<link rel="canonical" href=""><!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>        
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/custom.js')}}"></script>
	</body>
</html>	
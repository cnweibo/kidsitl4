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
		<form action="#" method="POST" role="form">
			<legend>Form title</legend>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
	
			</div>
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
		
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<hr>
		<form action="" method="POST" role="form">
			<legend>using <span class="text-warning">bs3-input command</span> </legend>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">url</label>
				<input type="url" name="urlname" id="inputUrlname" class="form-control" value="http://www.baidu.com" required="required" title="url input">
			</div>
			<input type="tel" name="telinpu" id="inputTelinpu" class="form-control" value="telephone" required="required" title="">
			<input type="week" name="" id="input" class="form-control" value="week" required="required" title="">
			<input type="color" name="" id="input" class="form-control" value="color" required="required" title="color select">
			<input type="number" name="" id="input" class="form-control" value="number" min="{5"} max="" step="" required="required" title="">
			<input type="search" name="" id="input" class="form-control" value="search" required="required" title="">
			<select name="" id="input" class="form-control">
				<option value="">-- Select One --</option>
				<option value="">-- Select two --</option>
				<option value="">-- Select three --</option>
			</select>
			<input type="hidden" name="" id="input" class="form-control" value="">
			<input type="password" name="" id="input" class="form-control" required="required" title="">
			<div class="checkbox">
				<label>
					<input type="checkbox" value="1">
					Checkbox
				</label>
			</div>
			<div class="form-group">
				<label for="input" class="col-sm-2 control-label">rangeinput:</label>
				<div class="col-sm-10">
					<input type="range" name="" id="input" class="form-control" value= "" min="{6"} max="10" step="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-offset-2">
					<input type="reset" value="Reset" class="btn btn-default">
				</div>
			</div>
			<input type="email" name="email" id="inputEmail" class="form-control" value="email input" required="required" title="email">
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>        
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/custom.js')}}"></script>
	</body>
</html>
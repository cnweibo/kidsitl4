<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
            Administration
		@show
	</title>

	<meta name="keywords" content="@yield('keywords')" />
	<meta name="author" content="@yield('author')" />
	<!-- Google will often use this as its description of your page/site. Make it good. -->
	<meta name="description" content="@yield('description')" />

	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	<meta name="google-site-verification" content="">

	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="@yield('description')">
	<meta name="DC.creator" content="@yield('author')">

	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- This is the traditional favicon.
	 - size: 16x16 or 32x32
	 - transparency is OK
	 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
	<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.ico') }}}">

	<!-- iOS favicons. -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

	<!-- CSS   ,prettify.css,bootstrap-wysihtml5.css,datatables-bootstrap.css,colorbox.css,custom.css-->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css,bootstrap-theme.min.css,bootstrap-prettify.css,bootstrap-wysihtml5.css,datatables-bootstrap.css,colorbox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/shockiconedu/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/fonts/font-awesome-4.1.0/css/font-awesome.min.css')}}">
    @yield('css')
<!--     <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/prettify.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/bootstrap-wysihtml5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables-bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/colorbox.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/custom.css')}}"> -->
	<style>
	body {
		padding: 60px 0;
	}
	</style>

	@yield('styles')

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="{{asset('bootstrap/js/html5shiv.js')}}"></script>
	  <script src="{{asset('bootstrap/js/respond.min.js')}}"></script>		  
	<![endif]-->

</head>

<body>
	<!-- Container -->
	<div class="container">
        <!-- Notifications -->
        @include('notifications')
        <!-- ./ notifications -->
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
    			<div class="collapse navbar-collapse navbar-ex1-collapse">
    				<ul class="nav navbar-nav" id="top-nav-left">
    					<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
    					<li{{ (Request::is('admin/blogs*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/blogs') }}}"><i class="glyphicon glyphicon-list-alt"></i> Blog</a></li>
    					<li{{ (Request::is('admin/comments*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/comments') }}}"><i class="glyphicon glyphicon-bullhorn"></i> Comments</a></li>
    					<li{{ (Request::is('admin/bishuns*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/bishuns') }}}"><i class="glyphicon glyphicon glyphicon-pencil"></i> 笔顺</a></li>
                        <li class="dropdown {{(Request::is('admin/yinbiao*') ? ' active' : '') }}">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/yinbiaos') }}}">
                                <i class="glyphicon glyphicon-sort-by-alphabet"></i> 音标<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li {{ (Request::is('admin/yinbiaocategory*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/yinbiaocategory') }}}"><span class="glyphicon glyphicon-list"></span> 音标类别管理</a></li>
                                <li {{ (Request::is('admin/yinbiaos*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/yinbiaos') }}}"><span class="glyphicon glyphicon-sort-by-alphabet"></span> 音标管理</a></li>
                                <li {{ (Request::is('admin/fayinguizes*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/fayinguizes') }}}"><span class="glyphicon glyphicon-retweet"></span> 发音规则管理</a></li>
                                <li {{ (Request::is('admin/yinbiaorelatedwords*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/yinbiaorelatedwords') }}}"><span class="glyphicon glyphicon-paperclip"></span> 相关单词管理</a></li>
                                <li {{ (Request::is('admin/relatedsentences*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/relatedsentences') }}}"><span class="glyphicon glyphicon-bullhorn"></span> 例句管理</a></li>
                                <li {{ (Request::is('admin/relatedsentences*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/guestaddedwords') }}}"><span class="glyphicon glyphicon-bullhorn"></span> 客词管理</a></li>
                            </ul>
                        </li>
                        <li class="dropdown {{(Request::is('admin/system/grade*') ? ' active' : '') }}">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/yinbiaos') }}}">
                                <i class="glyphicon glyphicon-cog"></i> 系统<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li {{ (Request::is('admin/system/grade*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/system/grade') }}}"><span class="glyphicon glyphicon-list"></span> 年级管理</a></li>
                                <li {{ (Request::is('admin/system/teacher*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/system/teacher') }}}"><span class="glyphicon glyphicon-sort-by-alphabet"></span> 老师管理</a></li>
                                <li {{ (Request::is('admin/system/classroom*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/system/classroom') }}}"><span class="shock-edu-classroom"></span> 教室管理</a></li>
                                <li {{ (Request::is('admin/system/student*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/system/student') }}}"><span class="glyphicon glyphicon-paperclip"></span> 学生管理</a></li>
                                <li {{ (Request::is('admin/system/editor*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/system/editor') }}}"><span class="glyphicon glyphicon-bullhorn"></span> 网站编辑管理</a></li>
                            </ul>
                        </li>
                        <li class="dropdown{{ (Request::is('admin/users*|admin/roles*') ? ' active' : '') }}">
    						<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/users') }}}">
    							<i class="glyphicon glyphicon-user"></i> Users <span class="caret"></span>
    						</a>
    						<ul class="dropdown-menu">
    							<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><span class="glyphicon glyphicon-user"></span> Users</a></li>
    							<li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><span class="glyphicon glyphicon-user"></span> Roles</a></li>
    						</ul>
    					</li>
    				</ul>
    				<ul class="nav navbar-nav pull-right" id="top-nav-right">
    					<li><a href="{{{ URL::to('/') }}}">View Homepage</a></li>
    					<li class="divider-vertical"></li>
    					<li class="dropdown">
    							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    								<span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}}	<span class="caret"></span>
    							</a>
    							<ul class="dropdown-menu">
    								<li><a href="{{{ URL::to('user/settings') }}}"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
    								<li class="divider"></li>
    								<li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span> Logout</a></li>
    							</ul>
    					</li>
    				</ul>
    			</div>
            </div>
		</div>
		<!-- ./ navbar -->

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->

	<!-- Javascripts    -->
    <script src="{{asset('bootstrap/js/jquery.min.js,bootstrap.min.js,wysihtml5-0.3.0.js,bootstrap-wysihtml5.js,jquery.dataTables.min.js,datatables-bootstrap.js,datatables.fnReloadAjax.js,jquery.colorbox.js,prettify.js,custom.js')}}"></script>
   <!--  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery.dataTables.min.js')}}"></script>    
    <script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
    <script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
    <script src="{{asset('assets/js/prettify.js')}}"></script> 
    <script src="{{asset('assets/js/custom.js')}}"></script> -->
    <script type="text/javascript">
    	$('.wysihtml5').wysihtml5();
        $(prettyPrint);
    </script>

    @yield('scripts')

</body>

</html>

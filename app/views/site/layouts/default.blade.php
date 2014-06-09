<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>
			@section('title')
			IT宝贝网-IT style learning,IT powered competence for China kids,IT从娃娃抓起，IT成为新世纪青少年必备生活技能
			@show
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Jon Doe" />
		<meta name="description" content="Lorem  description should be changed ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->

        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css,bootstrap-theme.min.css,custom.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}"> -->
        <!-- <link rel="stylesheet" href="{{asset('bootstrap/css/custom.css')}}"> -->
		<style>
        body {
            padding: 60px 0;
        }
		@section('styles')
		@show
		</style>

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
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-inverse navbar-fixed-top navbar-top-background">
			 <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">切换</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav"  id="top-nav-left">
						<li {{set_active('/')}}><a href="{{{ URL::to('') }}}">首页</a></li>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('') }}}">汉字笔顺<b class="caret"></b></a>
							<ul class="dropdown-menu">
					          <li><a href="http://kidsit.cn/admin">Action</a></li>
					          <li><a href="#">Another action</a></li>
					          <li><a href="#">Something else here</a></li>
					          <li class="divider"></li>
					          <li><a href="#">Separated link</a></li>
					        </ul>
						</li>
						<li {{set_active('pinyin')}}><a href="{{{ URL::to('/pinyin') }}}">拼音速学</a></li>
						<li {{set_active('phonetic')}}><a href="{{{ URL::to('phonetic') }}}">英语音标</a></li>
						<li {{set_active('exercise')}}><a href="{{{ URL::to('exercise') }}}">中小学同步课堂</a></li>						
						<li {{set_active('kidsinternet')}}><a href="{{{ URL::to('kidsinternet') }}}">互联网那点事儿</a></li>						
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>


					</ul>

                    <ul class="nav navbar-nav pull-right" id="top-nav-right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::to('admin') }}}">管理控制台</a></li>
                        @endif
                        <li><a href="{{{ URL::to('user') }}}">登录为： {{{ Auth::user()->username }}}</a></li>
                        <li><a href="{{{ URL::to('user/logout') }}}">退出</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">登录</a></li>
                        <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit">Laravel 4 Starter Site on <a href="https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site">Github</a>.</p>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js,bootstrap.min.js,custom.js')}}"></script>        
        <!-- <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> -->
        <!-- <script src="{{asset('bootstrap/js/custom.js')}}"></script> -->

        @yield('scripts')
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>@section('title')IT宝贝网-中国青少年信息化教育推动者，计算机信息教育先锋队，IT从娃娃抓起的践行者
@show
		</title>
		<meta name="keywords" content=@section('keywords')IT宝贝网
		@show />
		<meta name="author" content="IT宝贝网版权所有，如需转载请注明出处" />
		<meta name="description" content=@section('description')中国计算机从娃娃抓起的践行者和推动者，IT宝贝网-中国青少年信息化推动者，信息教育的先锋队 IT style learning,NIT competence for China kids
		@show 
		/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css,bootstrap-theme.min.css,custom.css')}}">
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
							<li {{set_active('bishun')}}><a href="{{{ URL::to('/bishun') }}}">笔顺学习</a></li>
							<li {{set_active('pinyin')}}><a href="{{{ URL::to('/pinyin') }}}">拼音速学</a></li>
							<li {{set_active('game')}}><a href="{{{ URL::to('/game') }}}">键盘练习</a></li>
							<li {{set_active('yinbiao')}}><a href="{{{ URL::to('yinbiao') }}}">英语音标</a></li>
							<li {{set_active('exercise')}}><a href="{{{ URL::to('exercise') }}}">中小学同步课堂</a></li>						
							<li {{set_active('kidsinternet')}}><a href="{{{ URL::to('kidsinternet') }}}">互联网那点事儿</a></li>						
							<li class="dropdown hidden">
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
					</div><!-- ./ nav-collapse end --> 
				</div> <!-- container end -->
			</div> <!-- ./ navbar end-->
			<div class="container"><!--  container of content start-->
				<!-- Notifications -->
				@include('notifications')
				<!-- ./ notifications -->
				<!-- content of carousel -->
				@yield('carousel')
				<!-- Content bishun flash search form -->
				@yield('contentbishunsearch')
				<!-- Content bishun flash-->
				@yield('contentbishun')
				<!-- Content blog-->
				@yield('content')
				<!-- ./ content blog-->
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-offset-3">
					@yield('typinggame')	
				</div>
			</div><!-- container end -->

			<!-- the following div is needed to make a sticky footer -->
			<div id="push"></div>
		</div><!-- ./wrap -->

	    <div id="footer">
			<div class="container">
				<p class="muted credit aligncenter inlineblock">版权所有 © {{date('Y')}} <a href="http://kidsit.cn">IT宝贝网</a></p>
				<!-- baidu tongji -->
				<script type="text/javascript">
				var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
				document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F53722a1e9a4275bed7713037cafa3b9d' type='text/javascript'%3E%3C/script%3E"));
				</script>
			</div>
	    </div>

		<!-- Javascripts
		================================================== -->
        <script src="{{asset('bootstrap/js/jquery.min.js,bootstrap.min.js,custom.js')}}"></script>        
        <!-- <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> -->
        <!-- <script src="{{asset('bootstrap/js/custom.js')}}"></script> -->

        @yield('scripts')
		<!-- daiyanbao -->
        <!--<div id="daiyanbao_com_content" style="position: fixed;_position: absolute;text-align: left;overflow: visible;bottom :0;right:0;display:block; z-index:999;">
        <script src="http://res.daiyanbao.com/freevideojs/304/1/88888888.js"></script>
        </div> -->
	</body>
</html>

@extends('site.layouts.default')
{{-- content for the carousel:slider --}}
@section('carousel')
	@include('site.partials.carousel')
@stop
{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun.bishunpartial')
@stop
@section('typinggame')
	@include('site.games.typinggamepartial')
@stop
{{-- Content blog--}}
@section('contentblog')

{{testforbladecall()}}

@stop
@section('scripts')
	<script type="text/javascript" src="{{asset('dist/siteindex.min.js')}}"></script>
<!--
	<script type="text/javascript" src="{{asset('htmlapp/libs/jquery/dist/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/jquery-color/jquery.color.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('htmlapp/syscommon/custom.js')}}"></script>
-->
    @include('phptojsvariables')
@stop
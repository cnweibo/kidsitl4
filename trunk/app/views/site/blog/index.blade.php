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

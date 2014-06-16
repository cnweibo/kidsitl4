@extends('site.layouts.default')
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

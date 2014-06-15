@extends('site.layouts.default')

{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun')
@stop
@section('typinggame')
	@include('site.typinggame')
@stop
{{-- Content blog--}}
@section('contentblog')

{{testforbladecall()}}

@stop

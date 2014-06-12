@extends('site.layouts.default')

{{-- Content for bishun flash --}}
@section('contentbishun')
	@include('site.bishun')
@stop
{{-- Content blog--}}
@section('contentblog')

{{testforbladecall()}}

@stop

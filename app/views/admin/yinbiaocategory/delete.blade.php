@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete yinbiao Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($yinbiaocat)){{URL::route('postyinbiaocatdelete',$yinbiaocat,['class'=>'yinbiaoatag']) }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $yinbiaocat }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                删除 {{Yinbiaocategory::find($yinbiaocat)->ybcategory}} 的音标类别信息？                
                <element class="btn-cancel close_popup"><button class="btn btn-primary">取消</button></element>
                <button type="submit" class="btn btn-danger">删除</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop
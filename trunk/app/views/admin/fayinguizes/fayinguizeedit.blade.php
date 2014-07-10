@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Meta data</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit yinbiao Form --}}

	<form class="form-horizontal" method="post" action="@if (isset($fayinguizeModel)){{ URL::to('admin/fayinguizes/' . $fayinguizeModel->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<!-- yinbiao id -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="id">发音规则ID：</label>
						<input class="form-control" type="text" name="id" id="id" value="{{{$fayinguizeModel->id}}}" />
						{{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- yinbiao name -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title">发音规则：</label>
						<input class="form-control" type="text" name="title" id="title" value="{{{$fayinguizeModel->title}}}" />
						{{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
					</div>
				</div>

				<div class="form-group">
					<div class="panel panel-info">
							<div class="panel-heading">
							<h3 class="panel-title">所属音标</h3>
							</div>
							<div class="panel-body">
    	                        <label class="control-label" for="yinbiao_id">所属音标:</label>
    							<select size=6 name="yinbiao_id" id="yinbiao_id">
    								@foreach (Yinbiao::all() as $yinbiao)
    									<option @if ($fayinguizeModel->yinbiao_id == $yinbiao->id) selected="selected"@endif value={{$yinbiao->id}}>{{$yinbiao->name}}</option>
    								@endforeach
    								
    							</select>
				            </div>
				    </div>		
				</div>

				<!-- yinbiao category -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="description">规则描述：</label>
						
						<input class="form-control" type="text" name="description" id="description" value="{{{$fayinguizeModel->description}}}" />

						{{{ $errors->first('content', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- guize regex -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="regex">regex</label>
						
						<input class="form-control" type="text" name="regex" id="regex" value="{{{$fayinguizeModel->regex}}}" />

						{{{ $errors->first('content', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}" />
						{{{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}" />
						{{{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}" />
						{{{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta keywords -->
			</div>
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop

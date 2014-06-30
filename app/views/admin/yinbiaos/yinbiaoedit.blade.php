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

	<form class="form-horizontal" method="post" enctype="multipart/form-data"  action="@if (isset($yinbiaosModel)){{ URL::to('admin/yinbiaos/' . $yinbiaosModel->id . '/edit') }}@endif" autocomplete="off">
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
                        <label class="control-label" for="id">音标ID：</label>
						<input class="form-control" type="text" name="id" id="id" value="{{{$yinbiaosModel->id}}}" />
						{{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- yinbiao name -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="yinbiao">音标：</label>
						<input class="form-control" type="text" name="yinbiao" id="yinbiao" value="{{{$yinbiaosModel->name}}}" />
						{{{ $errors->first('title', '<span class="help-block">:message</span>') }}}
					</div>
				</div>

				<!-- yinbiao category -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="yinbiaocategory_id">音标分类：</label>
						<select name="yinbiaocategory_id" id="yinbiaocategory_id">
							@foreach (Yinbiaocategory::all() as $yinbiaocat)
								<option value={{$yinbiaocat->id}}>{{$yinbiaocat->ybcategory}}</option>
							@endforeach
							
						</select>
						{{{ $errors->first('content', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- yinbiao mp3 file name -->
				<div class="form-group">
					<div class="col-md-12">
						{{Form::label('mp3','音标mp3文件：')}}
						{{Form::file('mp3')}}
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

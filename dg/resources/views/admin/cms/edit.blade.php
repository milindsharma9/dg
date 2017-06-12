@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('admin/cms.edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>
{!! Form::model($cms, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.cms.update', $cms->id))) !!}


<div class="form-group">
    {!! Form::label('title', 'Title*', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', old('title', $cms->title), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('display', 'display*', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('display', old('display', $cms->display), ['class' => 'form-control', 'disabled' => true]) !!}
    </div>
</div>

<!--div class="form-group">
    {!! Form::label('description', 'Description*', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', old('description',$cms->description), ['class' => 'form-control']) !!}
    </div>
	
</div -->

<div class="form-group">
 <script src="{{ url('/') }}/ckeditor/ckeditor.js"></script>
  {!! Form::label('description', 'Description*', ['class' => 'col-sm-2 control-label']) !!}
 <div class="col-sm-10">
  <textarea name="description" id="description" rows="10" cols="30" >@if (Input::old('description')!='') {{ Input::old('description') }} @else {{ $cms->description }} @endif</textarea>
			
			 <script>
               CKEDITOR.replace( 'description', {
		
      filebrowserBrowseUrl: '{{ url('/') }}/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '{{ url('/') }}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
	
	
	
			   });
            </script>
    
    
</div>


<div class="form-group">
    {!! Form::label('meta_title', 'Meta Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_title', old('meta_title', $cms->meta_title), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description', $cms->meta_description), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('keywords', 'Meta Keywords', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('keywords', old('keywords', $cms->keywords), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('meta_title', 'Meta Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_title', old('meta_title', $cms->meta_title), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description', $cms->meta_description), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_keywords', 'Meta Keywords', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_keywords', old('meta_keywords', $cms->meta_keywords), ['class' => 'form-control']) !!}
    </div>
</div>




<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('admin/cms.update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.cms.index', trans('admin/cms.cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection

@section('javascript')
{{--WYSIWYG editor--}}
<script src="{{ url('vendor/unisharp/laravel-ckeditor') }}/ckeditor.js?v={{ env('ASSETS_VERSION_NUMBER') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'description' );
    </script>
@endsection
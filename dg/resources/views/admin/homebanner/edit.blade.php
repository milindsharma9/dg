@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('admin/homebanner.edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('files' => true,'method' => 'PATCH',  'route' => array('admin.homebanner.update',$clients->id), 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}



<div class="form-group">
    {!! Form::label('filename', 'image File*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('filename') !!}
       @if($clients->filename!='')
		
	{{ Html::link(url('/') . "/" . $filepath . "/" .$clients->filename  , 'View File',['target'=>'_blank'])}}
		
		@endif
    </div>
	
</div>


<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('admin/homebanner.update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.homebanner.edit', trans('admin/homebanner.cancel'), 1, array('class' => 'btn btn-default')) !!}
    </div>
</div>


{!! Form::close() !!}

@endsection



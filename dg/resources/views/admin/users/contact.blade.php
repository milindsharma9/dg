<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Laravel Form BotDetect CAPTCHA Example</title>
  
  <!-- include the BotDetect layout stylesheet -->
  <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
</head>
<body>
  <h2>Laravel Form BotDetect CAPTCHA Example</h2>
 @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
{!! Form::open(array('files' => false, 'route' => 'contactfom', 'id' => 'contact-us-form', 'method' => 'POST')) !!}
  
 @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('fullname') }}</strong>
      </span>
    @endif

    <div class="form-group">
    {!! Form::label('fullname', 'Name*', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('fullname', old('fullname'), ['class' => 'form-control']) !!}
    </div>
</div>
    
    <!-- show captcha image html -->
    <label>Retype the characters from the picture</label>
    {!! captcha_image_html('ContactCaptcha') !!}
    <input type="text" id="CaptchaCode" name="CaptchaCode">

    @if ($errors->has('CaptchaCode'))
      <span class="help-block">
        <strong>{{ $errors->first('CaptchaCode') }}</strong>
      </span>
    @endif

    <br>
    <button type="submit" class="btn">Submit</button>
{!! Form::close() !!}
</body>
</html>
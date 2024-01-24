@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
Reset Password
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

           {{ html()->form('POST', route('postResetPassword'))->class('panel')->open() }}

            <div class="panel-body">
                <div class="logo">
                   {!!Html::image('assets/images/logo-dark.png')!!}
                </div>
                <h2>@lang("User.reset_password")</h2>
                @if (Session::has('status'))
                <div class="alert alert-info">
                    @lang("User.reset_password_success")
                </div>
                @else

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>@lang("basic.whoops")!</strong> @lang("User.reset_input_errors")<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group">
                    {{ html()->label(trans("User.your_email"), 'email')->class('control-label') }}
                    {{ html()->text('email')->class('form-control')->autofocus(true) }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans("User.new_password"), 'password')->class('control-label') }}
                    {{ html()->password('password')->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans("User.confirm_new_password"), 'password_confirmation')->class('control-label') }}
                    {{ html()->password('password_confirmation')->class('form-control') }}
                </div>
                {{ html()->hidden('token', $token) }}
                <div class="form-group nm">
                    <button type="submit" class="btn btn-block btn-success">Submit</button>
                </div>
                <div class="signup">
                  <a class="semibold" href="{{route('login')}}">
                      <i class="ico ico-arrow-left"></i> @lang("basic.back_to_login")
                  </a>
                </div>
            </div>
            {{ html()->form()->close() }}

            @endif
        </div>
    </div>
@stop

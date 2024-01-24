@extends('Shared.Layouts.MasterWithoutMenus')

@section('title', trans("User.login"))

@section('content')
    {{ html()->form('POST', route("login"))->id('login-form')->open() }}
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        {!!Html::image('assets/images/logo-dark.png')!!}
                    </div>

                    @if(Session::has('failed'))
                        <h4 class="text-danger mt0">@lang("basic.whoops")! </h4>
                        <ul class="list-group">
                            <li class="list-group-item">@lang("User.login_fail_msg")</li>
                        </ul>
                    @endif

                    <div class="form-group">
                        {{ html()->label(trans("User.email"), 'email')->class('control-label') }}
                        {{ html()->text('email')->class('form-control')->autofocus(true) }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("User.password"), 'password')->class('control-label') }}
                        (<a class="forgotPassword" href="{{route('forgotPassword')}}" tabindex="-1">@lang("User.forgot_password?")</a>)
                        {{ html()->password('password')->class('form-control') }}
                    </div>

                    @include('Public.LoginAndRegister.Partials.CaptchaSection')

                    <div class="form-group">
                        <p><input class="btn btn-block btn-success" type="submit" value="@lang('User.login')"></p>
                    </div>

                    @if(Utils::isAttendize())
                    <div class="signup">
                        <span>@lang("User.dont_have_account_button", ["url"=> route('showSignup')])</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@stop

@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
    @lang("User.sign_up")
@stop

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            {{ html()->form('POST', route("showSignup"))->class('panel')->id('signup-form')->open() }}
            <div class="panel-body">
                <div class="logo">
                   {{ html()->img('assets/images/logo-dark.png') }}
                </div>
                <h2>@lang("User.sign_up")</h2>

                @if(Request::input('first_run'))
                    <div class="alert alert-info">
                        @lang("User.sign_up_first_run")
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                            {{ html()->label(trans("User.first_name"), 'first_name')->class('control-label required') }}
                            {{ html()->text('first_name')->class('form-control') }}
                            @if($errors->has('first_name'))
                                <p class="help-block">{{ $errors->first('first_name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                            {{ html()->label(trans("User.last_name"), 'last_name')->class('control-label required') }}
                            {{ html()->text('last_name')->class('form-control') }}
                            @if($errors->has('last_name'))
                                <p class="help-block">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                    {{ html()->label(trans("User.email"), 'email')->class('control-label required') }}
                    {{ html()->text('email')->class('form-control') }}
                    @if($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                    {{ html()->label(trans("User.password"), 'password')->class('control-label required') }}
                    {{ html()->password('password')->class('form-control') }}
                    @if($errors->has('password'))
                        <p class="help-block">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                    {{ html()->label('Password again', 'password_confirmation')->class('control-label required') }}
                    {{ html()->password('password_confirmation')->class('form-control') }}
                    @if($errors->has('password_confirmation'))
                        <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                @if(Utils::isAttendizeCloud())
                <div class="form-group {{ ($errors->has('terms_agreed')) ? 'has-error' : '' }}">
                    <div class="checkbox custom-checkbox">
                        {{ html()->checkbox('terms_agreed', false, old('terms_agreed'))->id('terms_agreed') }}
                        {{ html()->rawlabel('terms_agreed', trans("User.terms_and_conditions", ["url" => route('termsAndConditions')])) }}
                        @if ($errors->has('terms_agreed'))
                            <p class="help-block">{{ $errors->first('terms_agreed') }}</p>
                        @endif
                    </div>
                </div>
                @endif

                @include('Public.LoginAndRegister.Partials.CaptchaSection')

                <div class="form-group">
                    <p><input class="btn btn-block btn-success" type="submit" value="@lang('User.sign_up')"></p>
                </div>
                <div class="signup">
                    <span>{!! @trans("User.already_have_account", ["url"=>route("login")]) !!}</span>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@stop

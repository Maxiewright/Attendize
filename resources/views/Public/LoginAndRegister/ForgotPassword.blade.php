@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
@lang("User.forgot_password")
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            {{ html()->form('POST', route('postForgotPassword'))->class('panel')->open() }}

            <div class="panel-body">

                <div class="logo">
                   {!!Html::image('assets/images/logo-dark.png')!!}
                </div>
                <h2>@lang("User.forgot_password")</h2>

                @if (Session::has('status'))
                <div class="alert alert-info">
                    @lang("User.password_already_sent")
                </div>
                @else

                @if(Session::has('error'))
                <h4 class="text-danger mt0">@lang("basic.whoops")</h4>
                <ul class="list-group">
                    <li class="list-group-item">{{Session::get('error')}}</li>
                </ul>
                @endif

                <div class="form-group">
                   {{ html()->label(trans("User.your_email"), 'email') }}
                   {{ html()->text('email')->class('form-control')->autofocus(true) }}
                </div>

                <div class="form-group nm">
                    <button type="submit" class="btn btn-block btn-success">@lang("basic.submit")</button>
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

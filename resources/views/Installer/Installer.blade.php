@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
    @lang("Installer.title")
@stop

@section('head')
    <style>
        .modal-header {
            background-color: transparent !important;
            color: #666 !important;
            text-shadow: none !important;;
        }
        .alert-success {
            background-color: #dff0d8 !important;
            border-color: #d6e9c6  !important;
            color: #3c763d  !important;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        {{ html()->img('assets/images/logo-dark.png') }}
                    </div>

                    <h1>@lang("Installer.setup")</h1>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h3>@lang("Installer.php_version_check")</h3>
                    @if (version_compare(phpversion(), '7.1.3', '<'))
                        <div class="alert alert-warning">
                            {!! @trans("Installer.php_too_low", ["requires"=>"7.1.3", "has"=>phpversion()]) !!}
                        </div>
                    @else
                        <div class="alert alert-success">
                            {!! @trans("Installer.php_enough", ["requires"=>"7.1.3", "has"=>phpversion()]) !!}
                        </div>
                    @endif

                    <h3>@lang("Installer.files_n_folders_check")</h3>
                    @foreach($paths as $path)

                        @if(!File::isWritable($path))
                            <div class="alert alert-danger">
                            {!! @trans("Installer.path_not_writable", ["path"=>$path]) !!}
                            </div>
                        @else
                            <div class="alert alert-success">
                            {!! @trans("Installer.path_writable", ["path"=> $path]) !!}
                            </div>
                        @endif

                    @endforeach

                    <h3>@lang("Installer.php_requirements_check")</h3>
                    @foreach($requirements as $requirement)

                        @if(!extension_loaded($requirement))
                            <div class="alert alert-danger">
                                {!! @trans("Installer.requirement_not_met", ["requirement"=>$requirement]) !!}
                            </div>
                        @else
                            <div class="alert alert-success">
                                {!! @trans("Installer.requirement_met", ["requirement"=>$requirement]) !!}
                            </div>
                        @endif

                    @endforeach

                    <h3>@lang("Installer.php_optional_requirements_check")</h3>

                    @foreach($optional_requirements as $optional_requirement)

                        @if(!extension_loaded($optional_requirement))
                            <div class="alert alert-warning">
                                {!! @trans("Installer.optional_requirement_not_met", ["requirement"=>$optional_requirement]) !!}
                            </div>
                        @else
                            <div class="alert alert-success">
                                {!! @trans("Installer.requirement_met", ["requirement"=>$optional_requirement]) !!}
                            </div>
                        @endif

                    @endforeach

                    {{ html()->form('POST', route('postInstaller'))->class('installer_form')->open() }}

                    <h3>@lang("Installer.app_settings")</h3>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.application_url"), 'app_url')->class('required control-label ') }}
                        {{ html()->text('app_url', $default_config['application_url'])->class('form-control')->placeholder('http://www.myticketsite.com') }}
                    </div>

                    <h3>@lang("Installer.database_settings")</h3>
                    <p>@lang("Installer.database_message")</p>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.database_type"), 'database_type')->class('required control-label ') }}
                        {{ html()->select('database_type', array('mysql' => "MySQL", 'pgsql' => "Postgres"), $default_config['database_type'])->class('form-control') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.database_host"), 'database_host')->class('control-label required') }}
                        {{ html()->text('database_host', $value = $default_config['database_host'])->class('form-control ')->placeholder('') }}


                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.database_name"), 'database_name')->class('required control-label required') }}
                        {{ html()->text('database_name', $value = $default_config['database_name'])->class('form-control') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.database_username"), 'database_username')->class('control-label required') }}
                        {{ html()->text('database_username', $value = $default_config['database_username'])->class('form-control ')->placeholder('') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.database_password"), 'database_password')->class('control-label required') }}
                        {{ html()->text('database_password', $value = $default_config['database_password'])->class('form-control ')->placeholder('') }}
                    </div>

                    <div class="form-group">
                        <script>
                            $(function () {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-Token': "{{csrf_token()}}"
                                    }
                                });

                                $('.test_db').on('click', function (e) {

                                    var url = $(this).attr('href');

                                    $.post(url, $(".installer_form").serialize(), function (data) {
                                        if (data.status === 'success') {
                                            alert('@lang("Installer.database_test_connect_success")');
                                        } else {
                                            alert('@lang("Installer.database_test_connect_failure")');
                                        }
                                    }, 'json').fail(function (data) {
                                        var returned = $.parseJSON(data.responseText);
                                        console.log(returned.error);
                                        alert('@lang("Installer.database_test_connect_failure_message")\n\n' + '@lang("Installer.database_test_connect_failure_error_type"): ' + returned.error.type + '\n' + '@lang("Installer.database_test_connect_failure_error_message"): ' + returned.error.message);
                                    });

                                    e.preventDefault();
                                });
                            });
                        </script>

                        <a href="{{route('postInstaller',['test' => 'db'])}}" class="test_db btn-block btn btn-success" style="color: white; font-weight: 300;">
                            @lang("Installer.test_database_connection")
                        </a>
                    </div>

                    <h3>@lang("Installer.email_settings")</h3>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_from_address"), 'mail_from_address')->class(' control-label required') }}
                        {{ html()->text('mail_from_address', $value = $default_config['mail_from_address'])->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_from_name"), 'mail_from_name')->class(' control-label required') }}
                        {{ html()->text('mail_from_name', $value = $default_config['mail_from_name'])->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_driver"), 'mail_driver')->class(' control-label required') }}
                        {{ html()->text('mail_driver', $value = $default_config['mail_driver'])->class('form-control ')->placeholder('mail') }}
                        <div class="help-block">
                           {!! @trans("Installer.mail_driver_help") !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_port"), 'mail_port')->class(' control-label ') }}
                        {{ html()->text('mail_port', $value = $default_config['mail_port'])->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_encryption"), 'mail_encryption')->class(' control-label ') }}
                        {{ html()->text('mail_encryption', $default_config['mail_encryption'])->class('form-control')->placeholder("tls/ssl") }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_host"), 'mail_host')->class(' control-label ') }}
                        {{ html()->text('mail_host', $value = $default_config['mail_host'])->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_username"), 'mail_username')->class(' control-label ') }}
                        {{ html()->text('mail_username', $default_config['mail_username'])->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Installer.mail_password"), 'mail_password')->class(' control-label ') }}
                        {{ html()->text('mail_password', $default_config['mail_password'])->class('form-control') }}
                    </div>
                    {!! csrf_field() !!}
                    @include("Installer.Partials.Footer")

                    {{ html()->submit(trans("Installer.install"))->class(" btn-block btn btn-success") }}
                    {{ html()->form()->close() }}

                </div>
            </div>
        </div>
    </div>
@stop

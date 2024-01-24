@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
    @lang("Organiser.create_organiser")
@stop

@section('head')
    <style>
        .modal-header {
            background-color: transparent !important;
            color: #666 !important;
            text-shadow: none !important;;
        }
    </style>
    @include('ManageOrganiser.Partials.OrganiserCreateAndEditJS')

@stop

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        {!!Html::image('assets/images/logo-dark.png')!!}
                    </div>
                    <h2>@lang("Organiser.create_organiser")</h2>

                    {{ html()->form('POST', route('postCreateOrganiser'))->class('ajax')->open() }}
                    @if(@$_GET['first_run'] == '1')
                        <div class="alert alert-info">
                            @lang("Organiser.create_organiser_text")
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_name"), 'name')->class('required control-label ') }}
                                {{ html()->text('name', old('name'))->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_email"), 'email')->class('control-label required') }}
                                {{ html()->text('email', old('email'))->class('form-control ')->placeholder(trans("Organiser.organiser_email_placeholder")) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.organiser_description"), 'about')->class('control-label') }}
                        {{ html()->textarea('about', old('about'))->class('form-control editable')->placeholder(trans("Organiser.organiser_description_placeholder"))->rows(4) }}
                    </div>
                    <div class="form-group">
                        <p class="control-label">{!! trans("Organiser.organiser_tax_prompt") !!}</p>
                        {{ html()->label('Yes', 'Yes')->class('control-label')->id('charge_yes') }}
                        {{ html()->radio('charge_tax', false, '1') }}
                        {{ html()->label('No', 'No')->class('control-label')->id('charge_no') }}
                        {{ html()->radio('charge_tax', true, '0') }}
                    </div>

                    <div id="tax_fields" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_tax_id"), 'tax_id')->class('control-label') }}
                                {{ html()->text('tax_id', old('tax_id'))->class('form-control')->placeholder('Tax ID') }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_tax_name"), 'tax_name')->class('control-label') }}
                                {{ html()->text('tax_name', old('tax_name'))->class('form-control')->placeholder('Tax name') }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_tax_value"), 'tax_value')->class('control-label') }}
                                {{ html()->text('tax_value', old('tax_value'))->class('form-control')->placeholder('Tax Value') }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_facebook"), 'facebook')->class('control-label ') }}

                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">facebook.com/</span>
                                    {{ html()->text('facebook', old('facebook'))->class('form-control ')->placeholder(trans("Organiser.organiser_username_facebook_placeholder")) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.organiser_twitter"), 'twitter')->class('control-label ') }}

                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">twitter.com/</span>
                                    {{ html()->text('twitter', old('twitter'))->class('form-control ')->placeholder(trans("Organiser.organiser_username_twitter_placeholder")) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Organiser.organiser_logo"), 'organiser_logo')->class('control-label ') }}
                        {{ html()->styledfile('organiser_logo') }}
                    </div>

                    {{ html()->submit(trans("Organiser.create_organiser"))->class(" btn-block btn btn-success") }}
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@stop

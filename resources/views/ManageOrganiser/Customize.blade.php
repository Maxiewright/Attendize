@extends('Shared.Layouts.Master')

@section('title')
    @parent
    {{ trans('Organiser.organiser_events') }}

@stop

@section('page_title')
    {{ trans('Organiser.organiser_name_events', ['name'=>$organiser->name]) }}
@stop

@section('top_nav')
    @include('ManageOrganiser.Partials.TopNav')
@stop

@section('head')
    <style>
        .page-header {
            display: none;
        }
    </style>
    <script>
        $(function () {
            $('.colorpicker').minicolors({
                changeDelay: 500,
                change: function () {
                    var replaced = replaceUrlParam('{{route('showOrganiserHome', ['organiser_id'=>$organiser->id])}}', 'preview_styles', encodeURIComponent($('#OrganiserPageDesign form').serialize()));
                    document.getElementById('previewIframe').src = replaced;
                }
            });

        });

    </script>
    @include('ManageOrganiser.Partials.OrganiserCreateAndEditJS')
@stop

@section('menu')
    @include('ManageOrganiser.Partials.Sidebar')
@stop

@section('page_header')

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#organiserSettings" data-toggle="tab">@lang("Organiser.organiser_settings")</a>
                </li>
                <li>
                    <a href="#OrganiserPageDesign" data-toggle="tab">@lang("Organiser.organiser_page_design")</a>
                </li>
            </ul>
            <div class="tab-content panel">
                <div class="tab-pane active" id="organiserSettings">
                    {{ html()->modelForm($organiser, 'POST', route('postEditOrganiser', ['organiser_id' => $organiser->id]))->class('ajax')->open() }}

                    <div class="form-group">
                        {{ html()->label(trans("Organiser.enable_public_organiser_page"), 'enable_organiser_page')->class('control-label required') }}
                        {{ html()->select('enable_organiser_page', ['1' => trans("Organiser.make_organiser_public"), '0' => trans("Organiser.make_organiser_hidden")], old('enable_organiser_page'))->class('form-control') }}
                        <div class="help-block">
                            @lang("Organiser.organiser_page_visibility_text")
                        </div>
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.organiser_name"), 'name')->class('required control-label ') }}
                        {{ html()->text('name', old('name'))->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.organiser_email"), 'email')->class('control-label required') }}
                        {{ html()->text('email', old('email'))->class('form-control ')->placeholder(trans("Organiser.organiser_email_placeholder")) }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.organiser_description"), 'about')->class('control-label') }}
                        {{ html()->textarea('about', old('about'))->class('form-control editable')->placeholder(trans("Organiser.organiser_description_placeholder"))->rows(4) }}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="control-label">{!! trans("Organiser.organiser_tax_prompt") !!}</p>
                                <label for="Yes" class="control-label" id="charge_yes">{!! trans("Organiser.yes") !!}</label>
                                <input id="charge_yes" name="charge_tax" type="radio" value="1" {{ $organiser->charge_tax == 1 ? 'checked' : '' }}>
                                <label for="No" class="control-label" id="charge_no">{!! trans("Organiser.no") !!}</label>
                                <input id="charge_yes" name="charge_tax" type="radio" value="0" {{ $organiser->charge_tax == 0 ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div id="tax_fields">
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
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.google_analytics_code"), 'google_analytics_code')->class('control-label') }}
                        {{ html()->text('google_analytics_code', old('google_analytics_code'))->class('form-control')->placeholder(trans("Organiser.google_analytics_code_placeholder")) }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Organiser.google_tag_manager_code"), 'google_tag_manager_code')->class('control-label') }}
                        {{ html()->text('google_tag_manager_code', old('google_tag_manager_code'))->class('form-control')->placeholder(trans("Organiser.google_tag_manager_code_placeholder")) }}
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
                    @if(is_file($organiser->logo_path))
                        <div class="form-group">
                            {{ html()->label(trans("Organiser.current_logo"), 'current_logo')->class('control-label ') }}

                            <div class="thumbnail">
                                {{ html()->img($organiser->logo_path) }}
                                {{ html()->label(trans("Organiser.delete_logo?"), 'remove_current_image')->class('control-label ') }}
                                {{ html()->checkbox('remove_current_image', false) }}
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        {{ html()->labelwithhelp('organiser_logo', trans("Organiser.organiser_logo"), array('class' => 'control-label '), trans("Organiser.organiser_logo_help")) }}
                        {{ html()->styledfile('organiser_logo') }}
                    </div>
                    <div class="modal-footer">
                        {{ html()->submit(trans("Organiser.save_organiser"))->class("btn btn-success") }}
                    </div>
                    {{ html()->closeModelForm() }}
                </div>
                <div class="tab-pane scale_iframe" id="OrganiserPageDesign">
                    {{ html()->modelForm($organiser, 'POST', route('postEditOrganiserPageDesign', ['organiser_id' => $organiser->id]))->class('ajax ')->open() }}

                    <div class="row">

                        <div class="col-md-6">
                            <h4>@lang("Organiser.organiser_design")</h4>

                            <div class="form-group">
                                {{ html()->label(trans("Organiser.header_background_color"), 'page_header_bg_color')->class('control-label required ') }}
                                {{ html()->input('text', 'page_header_bg_color', old('page_header_bg_color'))->class('form-control colorpicker')->placeholder('#000000') }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.text_color"), 'page_text_color')->class('control-label required ') }}
                                {{ html()->input('text', 'page_text_color', old('page_text_color'))->class('form-control colorpicker')->placeholder('#FFFFFF') }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Organiser.background_color"), 'page_bg_color')->class('control-label required ') }}
                                {{ html()->input('text', 'page_bg_color', old('page_bg_color'))->class('form-control colorpicker')->placeholder('#EEEEEE') }}
                            </div>
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>@lang("Organiser.organiser_page_preview")</h4>
                            <div class="preview iframe_wrap"
                                 style="overflow:hidden; height: 500px; border: 1px solid #ccc; overflow: hidden;">
                                <iframe id="previewIframe"
                                        src="{{ route('showOrganiserHome', ['organiser_id' => $organiser->id]) }}"
                                        frameborder="0" style="overflow:hidden;height:100%;width:100%" width="100%"
                                        height="100%"></iframe>
                            </div>
                        </div>


                    </div>

                    <div class="panel-footer mt15 text-right">
                        {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                    </div>

                    {{ html()->closeModelForm() }}

                </div>
            </div>
        </div>
@stop

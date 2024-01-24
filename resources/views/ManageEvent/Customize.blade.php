{{-- @todo Rewrite the JS for choosing event bg images and colours. --}}
@extends('Shared.Layouts.Master')

@section('title')
    @parent
    @lang("Event.customize_event")
@stop

@section('top_nav')
    @include('ManageEvent.Partials.TopNav')
@stop

@section('menu')
    @include('ManageEvent.Partials.Sidebar')
@stop

@section('page_title')
    <i class="ico-cog mr5"></i>
    @lang("Event.customize_event")
@stop

@section('page_header')
    <style>
        .page-header {
            display: none;
        }
    </style>
@stop

@section('head')
    {!! Html::script('https://maps.googleapis.com/maps/api/js?libraries=places&key='.config("attendize.google_maps_geocoding_key")) !!}
    {!! Html::script('vendor/geocomplete/jquery.geocomplete.min.js') !!}
    <script>
        $(function () {

            $("input[name='organiser_fee_percentage']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                verticalbuttons: true,
                forcestepdivisibility: 'none',
                postfix: '%',
                buttondown_class: "btn btn-link",
                buttonup_class: "btn btn-link",
                postfix_extraclass: "btn btn-link"
            });
            $("input[name='organiser_fee_fixed']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.01,
                decimals: 2,
                verticalbuttons: true,
                postfix: '{{$event->currency->symbol_left}}',
                buttondown_class: "btn btn-link",
                buttonup_class: "btn btn-link",
                postfix_extraclass: "btn btn-link"
            });

            /* Affiliate generator */
            $('#affiliateGenerator').on('keyup', function () {
                var text = $(this).val().replace(/\W/g, ''),
                        referralUrl = '{{$event->event_url}}?ref=' + text;

                $('#referralUrl').toggle(text !== '');
                $('#referralUrl input').val(referralUrl);
            });

            /* Background selector */
            $('.bgImage').on('click', function (e) {
                $('.bgImage').removeClass('selected');
                $(this).addClass('selected');
                $('input[name=bg_image_path_custom]').val($(this).data('src'));

                var replaced = replaceUrlParam('{{route('showEventPagePreview', ['event_id'=>$event->id])}}', 'bg_img_preview', $('input[name=bg_image_path_custom]').val());
                document.getElementById('previewIframe').src = replaced;
                e.preventDefault();
            });

            /* Background color */
            $('input[name=bg_color]').on('change', function (e) {
                var replaced = replaceUrlParam('{{route('showEventPagePreview', ['event_id'=>$event->id])}}', 'bg_color_preview', $('input[name=bg_color]').val().substring(1));
                document.getElementById('previewIframe').src = replaced;
                e.preventDefault();
            });

            $('#bgOptions .panel').on('shown.bs.collapse', function (e) {
                var type = $(e.currentTarget).data('type');
                console.log(type);
                $('input[name=bg_type]').val(type);
            });

            $('input[name=bg_image_path], input[name=bg_color]').on('change', function () {
                //showMessage('Uploading...');
                //$('.customizeForm').submit();
            });

            /* Color picker */
            $('.colorpicker').minicolors();

            $('#ticket_design .colorpicker').on('change', function (e) {
                var borderColor = $('input[name="ticket_border_color"]').val();
                var bgColor = $('input[name="ticket_bg_color"]').val();
                var textColor = $('input[name="ticket_text_color"]').val();
                var subTextColor = $('input[name="ticket_sub_text_color"]').val();

                $('.ticket').css({
                    'border': '1px solid ' + borderColor,
                    'background-color': bgColor,
                    'color': subTextColor,
                    'border-left-color': borderColor
                });
                $('.ticket h4').css({
                    'color': textColor
                });
                $('.ticket .logo').css({
                    'border-left': '1px solid ' + borderColor,
                    'border-bottom': '1px solid ' + borderColor
                });
                $('.ticket .barcode').css({
                    'border-right': '1px solid ' + borderColor,
                    'border-bottom': '1px solid ' + borderColor,
                    'border-top': '1px solid ' + borderColor
                });

            });

            $('#enable_offline_payments').change(function () {
                $('.offline_payment_details').toggle(this.checked);
            }).change();
        });


    </script>

    <style type="text/css">
        .bootstrap-touchspin-postfix {
            background-color: #ffffff;
            color: #333;
            border-left: none;
        }

        .bgImage {
            cursor: pointer;
        }

        .bgImage.selected {
            outline: 4px solid #0099ff;
        }
    </style>
    <script>
        $(function () {

            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
                $('.nav-tabs a[href=' + hash + ']').tab('show');
            }

            $(window).on('hashchange', function () {
                var newHash = location.hash;
                if (typeof newHash === undefined) {
                    $('.nav-tabs a[href=' + '#general' + ']').tab('show');
                } else {
                    $('.nav-tabs a[href=' + newHash + ']').tab('show');
                }

            });

            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });

        });


    </script>

@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- tab -->
            <ul class="nav nav-tabs">
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'general'])}}"
                    class="{{($tab == 'general' || !$tab) ? 'active' : ''}}"><a href="#general" data-toggle="tab">@lang("basic.general")</a>
                </li>
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'design'])}}"
                    class="{{$tab == 'design' ? 'active' : ''}}"><a href="#design" data-toggle="tab">@lang("basic.event_page_design")</a></li>
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'order_page'])}}"
                    class="{{$tab == 'order_page' ? 'active' : ''}}"><a href="#order_page" data-toggle="tab">@lang("basic.order_form")</a></li>

                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'social'])}}"
                    class="{{$tab == 'social' ? 'active' : ''}}"><a href="#social" data-toggle="tab">@lang("basic.social")</a></li>
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'affiliates'])}}"
                    class="{{$tab == 'affiliates' ? 'active' : ''}}"><a href="#affiliates"
                                                                        data-toggle="tab">@lang("basic.affiliates")</a></li>
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'fees'])}}"
                    class="{{$tab == 'fees' ? 'active' : ''}}"><a href="#fees" data-toggle="tab">@lang("basic.service_fees")</a></li>
                <li data-route="{{route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'ticket_design'])}}"
                    class="{{$tab == 'ticket_design' ? 'active' : ''}}"><a href="#ticket_design" data-toggle="tab">@lang("basic.ticket_design")</a></li>
            </ul>
            <!--/ tab -->
            <!-- tab content -->
            <div class="tab-content panel">
                <div class="tab-pane {{($tab == 'general' || !$tab) ? 'active' : ''}}" id="general">
                    @include('ManageEvent.Partials.EditEventForm', ['event'=>$event, 'organisers'=>\Auth::user()->account->organisers])
                </div>

                <div class="tab-pane {{$tab == 'affiliates' ? 'active' : ''}}" id="affiliates">

                    <h4>@lang("Affiliates.affiliate_tracking")</h4>

                    <div class="well">
                        @lang("Affiliates.affiliate_tracking_text")

                        <br><br>

                        <input type="text" id="affiliateGenerator" name="affiliateGenerator" class="form-control"/>

                        <div style="display:none; margin-top:10px; " id="referralUrl">
                            <input onclick="this.select();" type="text" name="affiliateLink" class="form-control"/>
                        </div>
                    </div>

                    @if($event->affiliates->count())
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>@lang("Affiliates.affiliate_name")</th>
                                    <th>@lang("Affiliates.visits_generated")</th>
                                    <th>@lang("Affiliates.ticket_sales_generated")</th>
                                    <th>@lang("Affiliates.sales_volume_generated")</th>
                                    <th>@lang("Affiliates.last_referral")</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($event->affiliates as $affiliate)
                                    <tr>
                                        <td>{{ $affiliate->name }}</td>
                                        <td>{{ $affiliate->visits }}</td>
                                        <td>{{ $affiliate->tickets_sold }}</td>
                                        <td>{{ money($affiliate->sales_volume, $event->currency) }}</td>
                                        <td>{{ $affiliate->updated_at->format(config("attendize.default_datetime_format")) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            @lang("Affiliates.no_affiliate_referrals_yet")
                        </div>
                    @endif


                </div>
                <div class="tab-pane {{$tab == 'social' ? 'active' : ''}}" id="social">
                    <div class="well hide"> <?php /*Seems like unfinished feature -> not translating*/ ?>
                        <h5>The following short codes are available for use:</h5>
                        Display the event's public URL: <code>[event_url]</code><br>
                        Display the organiser's name: <code>[organiser_name]</code><br>
                        Display the event title: <code>[event_title]</code><br>
                        Display the event description: <code>[event_description]</code><br>
                        Display the event start date & time: <code>[event_start_date]</code><br>
                        Display the event end date & time: <code>[event_end_date]</code>
                    </div>

                    {{ html()->modelForm($event, 'POST', route('postEditEventSocial', ['event_id' => $event->id]))->class('ajax ')->open() }}

                    <h4>@lang("Social.social_settings")</h4>

                    <div class="form-group hide">

                        {{ html()->label(trans("Social.social_share_text"), 'social_share_text')->class('control-label ') }}

                        {{ html()->textarea('social_share_text', $event->social_share_text)->class('form-control')->rows(4) }}
                        <div class="help-block">
                            @lang("Social.social_share_text_help")
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label">@lang("Social.share_buttons_to_show")</label>
                        <br>

                        <div class="custom-checkbox mb5">
                            {{ html()->checkbox('social_show_facebook', $event->social_show_facebook, 1)->id('social_show_facebook')->data('toggle', 'toggle') }}
                            {{ html()->label(trans("Social.facebook"), 'social_show_facebook') }}
                        </div>
                        <div class="custom-checkbox mb5">

                            {{ html()->checkbox('social_show_twitter', $event->social_show_twitter, 1)->id('social_show_twitter')->data('toggle', 'toggle') }}
                            {{ html()->label(trans("Social.twitter"), 'social_show_twitter') }}

                        </div>

                        <div class="custom-checkbox mb5">
                            {{ html()->checkbox('social_show_email', $event->social_show_email, 1)->id('social_show_email')->data('toggle', 'toggle') }}
                            {{ html()->label(trans("Social.email"), 'social_show_email') }}
                        </div>
                        <div class="custom-checkbox mb5">
                            {{ html()->checkbox('social_show_linkedin', $event->social_show_linkedin, 1)->id('social_show_linkedin')->data('toggle', 'toggle') }}
                            {{ html()->label(trans("Social.linkedin"), 'social_show_linkedin') }}
                        </div>
                        <div class="custom-checkbox">

                            {{ html()->checkbox('social_show_whatsapp', $event->social_show_whatsapp, 1)->id('social_show_whatsapp')->data('toggle', 'toggle') }}
                            {{ html()->label(trans("Social.whatsapp"), 'social_show_whatsapp') }}


                        </div>
                    </div>

                    <div class="panel-footer mt15 text-right">
                        {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                    </div>

                    {{ html()->closeModelForm() }}

                </div>
                <div class="tab-pane scale_iframe {{$tab == 'design' ? 'active' : ''}}" id="design">

                    <div class="row">
                        <div class="col-sm-6">

                            {{ html()->form('POST', route('postEditEventDesign', ['event_id' => $event->id]))->acceptsFiles()->class('ajax customizeForm')->open() }}

                            {{ html()->hidden('bg_type', $event->bg_type) }}

                            <h4>@lang("Design.background_options")</h4>

                            <div class="panel-group" id="bgOptions">

                                <div class="panel panel-default" data-type="color">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#bgOptions" href="#bgColor"
                                               class="{{($event->bg_type == 'color') ? '' : 'collapsed'}}">
                                                <span class="arrow mr5"></span> @lang("Design.use_a_colour_for_the_background")
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="bgColor"
                                         class="panel-collapse {{($event->bg_type == 'color') ? 'in' : 'collapse'}}">
                                        <div class="panel-body">
                                            {{ html()->text('bg_color', $event->bg_color)->class('colorpicker form-control') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default" data-type="image">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#bgOptions" href="#bgImage"
                                               class="{{($event->bg_type == 'image') ? '' : 'collapsed'}}">
                                                <span class="arrow mr5"></span> @lang("Design.select_from_available_images")
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="bgImage"
                                         class="panel-collapse {{($event->bg_type == 'image') ? 'in' : 'collapse'}}">
                                        <div class="panel-body">
                                            @foreach($available_bg_images_thumbs as $bg_image)

                                                <img data-3="{{str_replace('/thumbs', '', $event->bg_image_path)}}"
                                                     class="img-thumbnail ma5 bgImage {{ ($bg_image === str_replace('/thumbs', '', $event->bg_image_path) ? 'selected' : '') }}"
                                                     style="width: 120px;" src="{{asset($bg_image)}}"
                                                     data-src="{{str_replace('/thumbs', '', substr($bg_image,1))}}"/>

                                            @endforeach

                                            {{ html()->hidden('bg_image_path_custom', $event->bg_type == 'image' ? $event->bg_image_path : '') }}
                                        </div>
                                            <a class="btn btn-link" href="https://pixabay.com?ref=attendize" title="PixaBay Free Images">
                                                @lang("Design.images_provided_by_pixabay")
                                            </a>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer mt15 text-right">
                                <span class="uploadProgress" style="display:none;"></span>
                                {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                            </div>

                            <div class="panel-footer ar hide">
                                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                                {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                            </div>

                            {{ html()->form()->close() }}

                        </div>
                        <div class="col-sm-6">
                            <h4>@lang("Design.event_page_preview")</h4>

                            <div class="iframe_wrap" style="overflow:hidden; height: 600px; border: 1px solid #ccc;">
                                <iframe id="previewIframe"
                                        src="{{route('showEventPagePreview', ['event_id'=>$event->id])}}"
                                        frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%"
                                        width="100%">
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane {{$tab == 'fees' ? 'active' : ''}}" id="fees">
                    {{ html()->modelForm($event, 'POST', route('postEditEventFees', ['event_id' => $event->id]))->class('ajax')->open() }}
                    <h4>@lang("Fees.organiser_fees")</h4>

                    <div class="well">
                        {!! @trans("Fees.organiser_fees_text") !!}
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Fees.service_fee_percentage"), 'organiser_fee_percentage')->class('control-label required') }}
                        {{ html()->text('organiser_fee_percentage', $event->organiser_fee_percentage)->class('form-control')->placeholder(trans("Fees.service_fee_percentage_placeholder")) }}
                        <div class="help-block">
                            {!! @trans("Fees.service_fee_percentage_help") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Fees.service_fee_fixed_price"), 'organiser_fee_fixed')->class('control-label required') }}
                        {{ html()->text('organiser_fee_fixed')->class('form-control')->placeholder(trans("Fees.service_fee_fixed_price_placeholder")) }}
                        <div class="help-block">
                            {!! @trans("Fees.service_fee_fixed_price_help", ["cur"=>$event->currency_symbol]) !!}
                        </div>
                    </div>
                    <div class="panel-footer mt15 text-right">
                        {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                    </div>
                    {{ html()->closeModelForm() }}
                </div>
                <div class="tab-pane" id="social"> <?php /* Seems like another unused section (duplicate id 'social') */ ?>
                    <h4>Social Settings</h4>

                    <div class="form-group">
                        <div class="checkbox custom-checkbox">
                            {{ html()->label('Show map on event page?', 'event_page_show_map')->id('customcheckbox')->class('control-label') }}
                            {{ html()->checkbox('event_page_show_map', false, 1) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label('Show social share buttons?', 'event_page_show_social_share')->class('control-label') }}
                        {{ html()->checkbox('event_page_show_social_share', false, 1) }}
                    </div>

                </div>

                <div class="tab-pane {{$tab == 'order_page' ? 'active' : ''}}" id="order_page">
                    {{ html()->modelForm($event, 'POST', route('postEditEventOrderPage', ['event_id' => $event->id]))->class('ajax ')->open() }}
                    <h4>@lang("Order.order_page_settings")</h4>

                    <div class="form-group">
                        {{ html()->label(trans("Order.before_order"), 'pre_order_display_message')->class('control-label ') }}

                        {{ html()->textarea('pre_order_display_message', $event->pre_order_display_message)->class('form-control')->rows(4) }}
                        <div class="help-block">
                            @lang("Order.before_order_help")
                        </div>

                    </div>
                    <div class="form-group">
                        {{ html()->label(trans("Order.after_order"), 'post_order_display_message')->class('control-label ') }}

                        {{ html()->textarea('post_order_display_message', $event->post_order_display_message)->class('form-control')->rows(4) }}
                        <div class="help-block">
                            @lang("Order.after_order_help")
                        </div>
                    </div>


                        <h4>@lang("Order.offline_payment_settings")</h4>
                        <div class="form-group">
                            <div class="custom-checkbox">
                                <input {{ $event->enable_offline_payments ? 'checked="checked"' : '' }} data-toggle="toggle" id="enable_offline_payments" name="enable_offline_payments" type="checkbox" value="1">
                                <label for="enable_offline_payments">@lang("Order.enable_offline_payments")</label>
                            </div>
                        </div>
                        <div class="offline_payment_details" style="display: none;">
                            {{ html()->textarea('offline_payment_instructions', $event->offline_payment_instructions)->class('form-control editable') }}
                            <div class="help-block">
                                @lang("Order.offline_payment_instructions")
                            </div>
                        </div>


                    <div class="panel-footer mt15 text-right">
                        {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                    </div>

                    {{ html()->closeModelForm() }}

                </div>


                <div class="tab-pane {{$tab == 'ticket_design' ? 'active' : ''}}" id="ticket_design">
                    {{ html()->modelForm($event, 'POST', route('postEditEventTicketDesign', ['event_id' => $event->id]))->class('ajax ')->open() }}
                    <h4>@lang("Ticket.ticket_design")</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Ticket.ticket_border_color"), 'ticket_border_color')->class('control-label required ') }}
                                {{ html()->input('text', 'ticket_border_color', old('ticket_border_color'))->class('form-control colorpicker')->placeholder('#000000') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Ticket.ticket_background_color"), 'ticket_bg_color')->class('control-label required ') }}
                                {{ html()->input('text', 'ticket_bg_color', old('ticket_bg_color'))->class('form-control colorpicker')->placeholder('#FFFFFF') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Ticket.ticket_text_color"), 'ticket_text_color')->class('control-label required ') }}
                                {{ html()->input('text', 'ticket_text_color', old('ticket_text_color'))->class('form-control colorpicker')->placeholder('#000000') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("Ticket.ticket_sub_text_color"), 'ticket_sub_text_color')->class('control-label required ') }}
                                {{ html()->input('text', 'ticket_sub_text_color', old('ticket_border_color'))->class('form-control colorpicker')->placeholder('#000000') }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ html()->label(trans("Ticket.show_1d_barcode"), 'is_1d_barcode_enabled')->class('control-label required') }}
                                {{ html()->select('is_1d_barcode_enabled', [1 => trans("basic.yes"), 0 => trans("basic.no")], $event->is_1d_barcode_enabled)->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <h4>@lang("Ticket.ticket_preview")</h4>
                            @include('ManageEvent.Partials.TicketDesignPreview')
                        </div>
                    </div>
                    <div class="panel-footer mt15 text-right">
                        {{ html()->submit(trans("basic.save_changes"))->class("btn btn-success") }}
                    </div>
                    {{ html()->closeModelForm() }}
                </div>
            <!--/ tab content -->
        </div>
    </div>
@stop

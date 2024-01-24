<div role="dialog"  class="modal fade" style="display: none;">

    @include('ManageOrganiser.Partials.EventCreateAndEditJS');

    {{ html()->form('POST', route('postCreateEvent'))->class('ajax gf')->open() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-calendar"></i>
                    @lang("Event.create_event")</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ html()->label(trans("Event.event_title"), 'title')->class('control-label required') }}
                            {{ html()->text('title', old('title'))->class('form-control')->placeholder(trans("Event.event_title_placeholder", ["name" => Auth::user()->first_name])) }}
                        </div>

                        <div class="form-group custom-theme">
                            {{ html()->label(trans("Event.event_description"), 'description')->class('control-label required') }}
                            {{ html()->textarea('description', old('description'))->class('form-control  editable')->rows(5) }}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ html()->label(trans("Event.event_start_date"), 'start_date')->class('required control-label') }}
                                    {{ html()->text('start_date', old('start_date'))->class('form-control start hasDatepicker ')->data('field', 'datetime')->data('startend', 'start')->data('startendelem', '.end')->isReadonly('') }}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ html()->label(trans("Event.event_end_date"), 'end_date')->class('required control-label ') }}

                                    {{ html()->text('end_date', old('end_date'))->class('form-control end hasDatepicker ')->data('field', 'datetime')->data('startend', 'end')->data('startendelem', '.start')->isReadonly('') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ html()->label(trans("Event.event_image"), 'event_image')->class('control-label ') }}
                            {{ html()->styledfile('event_image') }}

                        </div>
                        @if(!empty(config("attendize.google_maps_geocoding_key")))
                        <div class="form-group address-automatic">
                            {{ html()->label(trans("Event.venue_name"), 'name')->class('control-label required ') }}
                            {{ html()->text('venue_name_full', old('venue_name_full'))->class('form-control geocomplete location_field')->placeholder(trans("Event.venue_name_placeholder")) }}

                                    <!--These are populated with the Google places info-->
                            <div>
                                {{ html()->hidden('formatted_address', '')->class('location_field') }}
                                {{ html()->hidden('street_number', '')->class('location_field') }}
                                {{ html()->hidden('country', '')->class('location_field') }}
                                {{ html()->hidden('country_short', '')->class('location_field') }}
                                {{ html()->hidden('place_id', '')->class('location_field') }}
                                {{ html()->hidden('name', '')->class('location_field') }}
                                {{ html()->hidden('location', '')->class('location_field') }}
                                {{ html()->hidden('postal_code', '')->class('location_field') }}
                                {{ html()->hidden('route', '')->class('location_field') }}
                                {{ html()->hidden('lat', '')->class('location_field') }}
                                {{ html()->hidden('lng', '')->class('location_field') }}
                                {{ html()->hidden('administrative_area_level_1', '')->class('location_field') }}
                                {{ html()->hidden('sublocality', '')->class('location_field') }}
                                {{ html()->hidden('locality', '')->class('location_field') }}
                            </div>
                            <!-- /These are populated with the Google places info-->
                        </div>
                        <div class="address-manual" style="display:none;">
                            <h5>
                                @lang("Event.address_details")
                            </h5>

                            <div class="form-group">
                                {{ html()->label(trans("Event.venue_name"), 'location_venue_name')->class('control-label required ') }}
                                {{ html()->text('location_venue_name', old('location_venue_name'))->class('form-control location_field')->placeholder(trans("Event.venue_name_placeholder")) }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Event.address_line_1"), 'location_address_line_1')->class('control-label') }}
                                {{ html()->text('location_address_line_1', old('location_address_line_1'))->class('form-control location_field')->placeholder(trans("Event.address_line_1_placeholder")) }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Event.address_line_2"), 'location_address_line_2')->class('control-label') }}
                                {{ html()->text('location_address_line_2', old('location_address_line_2'))->class('form-control location_field')->placeholder(trans("Event.address_line_2_placeholder")) }}
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Event.city"), 'location_state')->class('control-label') }}
                                        {{ html()->text('location_state', old('location_state'))->class('form-control location_field')->placeholder(trans("Event.city_placeholder")) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Event.post_code"), 'location_post_code')->class('control-label') }}
                                        {{ html()->text('location_post_code', old('location_post_code'))->class('form-control location_field')->placeholder(trans("Event.post_code_placeholder")) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span>
                            <a data-clear-field=".location_field"
                               data-toggle-class=".address-automatic, .address-manual"
                               data-show-less-text="@lang("Event.or(manual/existing_venue)") <b>@lang("Event.enter_existing")</b>" href="javascript:void(0);"
                               class="in-form-link show-more-options clear_location">
                            @lang("Event.or(manual/existing_venue)") <b>@lang("Event.enter_manual")</b>
                            </a>
                        </span>
                        @else
                        <div class="address-manual">
                            <h5>
                                @lang("Event.address_details")
                            </h5>

                            <div class="form-group">
                                {{ html()->label(trans("Event.venue_name"), 'location_venue_name')->class('control-label required ') }}
                                {{ html()->text('location_venue_name', old('location_venue_name'))->class('form-control location_field')->placeholder(trans("Event.venue_name_placeholder")) }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Event.address_line_1"), 'location_address_line_1')->class('control-label') }}
                                {{ html()->text('location_address_line_1', old('location_address_line_1'))->class('form-control location_field')->placeholder(trans("Event.address_line_1_placeholder")) }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("Event.address_line_2"), 'location_address_line_2')->class('control-label') }}
                                {{ html()->text('location_address_line_2', old('location_address_line_2'))->class('form-control location_field')->placeholder(trans("Event.address_line_2_placeholder")) }}
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Event.city"), 'location_state')->class('control-label') }}
                                        {{ html()->text('location_state', old('location_state'))->class('form-control location_field')->placeholder(trans("Event.city_placeholder")) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(trans("Event.post_code"), 'location_post_code')->class('control-label') }}
                                        {{ html()->text('location_post_code', old('location_post_code'))->class('form-control location_field')->placeholder(trans("Event.post_code_placeholder")) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($organiser_id)
                            {{ html()->hidden('organiser_id', $organiser_id) }}
                        @else
                            <div class="create_organiser" style="{{$organisers->isEmpty() ? '' : 'display:none;'}}">
                                <h5>
                                    @lang("Organiser.organiser_details")
                                </h5>

                                <div class="form-group">
                                    {{ html()->label(trans("Organiser.organiser_name"), 'organiser_name')->class('required control-label ') }}
                                    {{ html()->text('organiser_name', old('organiser_name'))->class('form-control')->placeholder(trans("Organiser.organiser_name_placeholder")) }}
                                </div>
                                <div class="form-group">
                                    {{ html()->label(trans("Organiser.organiser_email"), 'organiser_email')->class('control-label required') }}
                                    {{ html()->text('organiser_email', old('organiser_email'))->class('form-control ')->placeholder(trans("Organiser.organiser_email_placeholder")) }}
                                </div>
                                <div class="form-group">
                                    {{ html()->label(trans("Organiser.organiser_description"), 'organiser_about')->class('control-label ') }}
                                    {{ html()->textarea('organiser_about', old('organiser_about'))->class('form-control editable2')->placeholder(trans("Organiser.organiser_description_placeholder"))->rows(4) }}
                                </div>
                                <div class="form-group more-options">
                                    {{ html()->label(trans("Organiser.organiser_logo"), 'organiser_logo')->class('control-label ') }}
                                    {{ html()->styledfile('organiser_logo') }}
                                </div>
                                <div class="row more-options">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ html()->label(trans("Organiser.organiser_facebook"), 'organiser_facebook')->class('control-label ') }}
                                            {{ html()->text('organiser_facebook', old('organiser_facebook'))->class('form-control ')->placeholder(trans("Organiser.organiser_facebook_placeholder")) }}

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ html()->label(trans("Organiser.organiser_twitter"), 'organiser_twitter')->class('control-label ') }}
                                            {{ html()->text('organiser_twitter', old('organiser_twitter'))->class('form-control ')->placeholder(trans("Organiser.organiser_twitter_placeholder")) }}

                                        </div>
                                    </div>
                                </div>

                                <a data-show-less-text="@lang("Organiser.hide_additional_organiser_options")" href="javascript:void(0);"
                                   class="in-form-link show-more-options">
                                    @lang("Organiser.additional_organiser_options")
                                </a>
                            </div>

                            @if(!$organisers->isEmpty())
                                <div class="form-group select_organiser" style="{{$organisers ? '' : 'display:none;'}}">

                                    {{ html()->label(trans("Organiser.select_organiser"), 'organiser_id')->class('control-label ') }}
                                    {{ html()->select('organiser_id', $organisers, $organiser_id)->class('form-control') }}

                                </div>
                                <span class="">
                                    @lang("Organiser.or") <a data-toggle-class=".select_organiser, .create_organiser"
                                       data-show-less-text="<b>@lang("Organiser.select_an_organiser")</b>" href="javascript:void(0);"
                                       class="in-form-link show-more-options">
                                        <b>@lang("Organiser.create_an_organiser")</b>
                                    </a>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span class="uploadProgress"></span>
                {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                {{ html()->submit(trans("Event.create_event"))->class("btn btn-success") }}
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>

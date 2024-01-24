@include('ManageOrganiser.Partials.EventCreateAndEditJS')

{{ html()->modelForm($event, 'POST', route('postEditEvent', ['event_id' => $event->id]))->class('ajax gf')->open() }}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
          {{ html()->label(trans("ManageEvent.default_currency"), 'currency_id')->class('control-label required') }}
          {{ html()->select('currency_id', $currencies, $event->currency_id)->class('form-control') }}
        </div>
        <div class="form-group">
            {{ html()->label(trans("Event.event_visibility"), 'is_live')->class('control-label required') }}
            {{ html()->select('is_live', ['1' => trans("Event.vis_public"), '0' => trans("Event.vis_hide")])->class('form-control') }}
        </div>
        <div class="form-group">
            {{ html()->label(trans("Event.event_title"), 'title')->class('control-label required') }}
            {{ html()->text('title', old('title'))->class('form-control')->placeholder(trans("Event.event_title_placeholder", ["name" => Auth::user()->first_name])) }}
        </div>

        <div class="form-group">
           {{ html()->label(trans("Event.event_description"), 'description')->class('control-label') }}
            {{ html()->textarea('description', old('description'))->class('form-control editable')->rows(5) }}
        </div>

        <div class="form-group address-automatic" style="display:{{$event->location_is_manual ? 'none' : 'block'}};">
            {{ html()->label(trans("Event.venue_name"), 'name')->class('control-label required ') }}
            {{ html()->text('venue_name_full', old('venue_name_full'))->class('form-control geocomplete location_field')->placeholder(trans("Event.venue_name_placeholder")) }}

            <!--These are populated with the Google places info-->
            <div>
               {{ html()->hidden('formatted_address', $event->location_address)->class('location_field') }}
               {{ html()->hidden('street_number', $event->location_street_number)->class('location_field') }}
               {{ html()->hidden('country', $event->location_country)->class('location_field') }}
               {{ html()->hidden('country_short', $event->location_country_short)->class('location_field') }}
               {{ html()->hidden('place_id', $event->location_google_place_id)->class('location_field') }}
               {{ html()->hidden('name', $event->venue_name)->class('location_field') }}
               {{ html()->hidden('location', '')->class('location_field') }}
               {{ html()->hidden('postal_code', $event->location_post_code)->class('location_field') }}
               {{ html()->hidden('route', $event->location_address_line_1)->class('location_field') }}
               {{ html()->hidden('lat', $event->location_lat)->class('location_field') }}
               {{ html()->hidden('lng', $event->location_long)->class('location_field') }}
               {{ html()->hidden('administrative_area_level_1', $event->location_state)->class('location_field') }}
               {{ html()->hidden('sublocality', '')->class('location_field') }}
               {{ html()->hidden('locality', $event->location_address_line_1)->class('location_field') }}
            </div>
            <!-- /These are populated with the Google places info-->

        </div>

        <div class="address-manual" style="display:{{$event->location_is_manual ? 'block' : 'none'}};">
            <div class="form-group">
                {{ html()->label(trans("Event.venue_name"), 'location_venue_name')->class('control-label required ') }}
                {{ html()->text('location_venue_name', $event->venue_name)->class('form-control location_field')->placeholder(trans("Event.venue_name_placeholder")) }}
            </div>
            <div class="form-group">
                {{ html()->label(trans("Event.address_line_1"), 'location_address_line_1')->class('control-label') }}
                {{ html()->text('location_address_line_1', $event->location_address_line_1)->class('form-control location_field')->placeholder(trans("Event.address_line_1_placeholder")) }}
            </div>
            <div class="form-group">
                {{ html()->label(trans("Event.address_line_2"), 'location_address_line_2')->class('control-label') }}
                {{ html()->text('location_address_line_2', $event->location_address_line_2)->class('form-control location_field')->placeholder(trans("Event.address_line_2_placeholder")) }}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label(trans("Event.city"), 'location_state')->class('control-label') }}
                        {{ html()->text('location_state', $event->location_state)->class('form-control location_field')->placeholder(trans("Event.city_placeholder")) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label(trans("Event.post_code"), 'location_post_code')->class('control-label') }}
                        {{ html()->text('location_post_code', $event->location_post_code)->class('form-control location_field')->placeholder(trans("Event.post_code_placeholder")) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" style="margin-top:-10px; padding: 5px; padding-top: 0px;">
            <span class="pull-right">
                @lang("Event.or(manual/existing_venue)") <a data-clear-field=".location_field" data-toggle-class=".address-automatic, .address-manual" data-show-less-text="{{$event->location_is_manual ? trans("Event.enter_manual"):trans("Event.enter_existing")}}" href="javascript:void(0);" class="show-more-options clear_location">{{$event->location_is_manual ? trans("Event.enter_existing"):trans("Event.enter_manual")}}</a>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ html()->label(trans("Event.event_start_date"), 'start_date')->class('required control-label') }}
                    {{ html()->text('start_date', $event->getFormattedDate('start_date'))->class('form-control start hasDatepicker ')->data('field', 'datetime')->data('startend', 'start')->data('startendelem', '.end')->isReadonly('') }}
                </div>
            </div>

            <div class="col-sm-6 ">
                <div class="form-group">
                    {{ html()->label(trans("Event.event_end_date"), 'end_date')->class('required control-label ') }}
                    {{ html()->text('end_date', $event->getFormattedDate('end_date'))->class('form-control end hasDatepicker ')->data('field', 'datetime')->data('startend', 'end')->data('startendelem', '.start')->isReadonly('') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   {{ html()->label(trans("Event.event_flyer"), 'event_image')->class('control-label ') }}
                   {{ html()->styledfile('event_image', 1) }}
                </div>

                @if($event->images->count())
                    <div class="form-group">
                        {{ html()->label(trans("Event.event_image_position"), 'event_image_position')->class('control-label') }}
                        {{ html()->select('event_image_position', ['' => trans("Event.event_image_position_hide"), 'before' => trans("Event.event_image_position_before"), 'after' => trans("Event.event_image_position_after"), 'left' => trans("Event.event_image_position_left"), 'right' => trans("Event.event_image_position_right")], old('event_image_position'))->class('form-control') }}
                    </div>
                    {{ html()->label(trans("Event.current_event_flyer"), '')->class('control-label ') }}
                    <div class="form-group">
                        <div class="well well-sm well-small">
                           {{ html()->label(trans("Event.delete?"), 'remove_current_image')->class('control-label ') }}
                           {{ html()->checkbox('remove_current_image', false) }}

                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="float-l">
                    @if($event->images->count())
                    <div class="thumbnail">
                       {!!Html::image('/'.$event->images->first()['image_path'])!!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ html()->label(trans("Organiser.google_tag_manager_code"), 'google_tag_manager_code')->class('control-label') }}
                    {{ html()->text('google_tag_manager_code', old('google_tag_manager_code'))->class('form-control')->placeholder(trans("Organiser.google_tag_manager_code_placeholder")) }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel-footer mt15 text-right">
           {{ html()->hidden('organiser_id', $event->organiser_id) }}
           {{ html()->submit(trans("Event.save_changes"))->class("btn btn-success") }}
        </div>
    </div>
    {{ html()->closeModelForm() }}
</div>


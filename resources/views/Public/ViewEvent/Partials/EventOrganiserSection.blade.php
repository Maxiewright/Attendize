<section id="organiser" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="event_organiser_details" property="organizer" typeof="Organization">
                <div class="logo">
                    <img alt="{{$event->organiser->name}}" src="{{asset($event->organiser->full_logo_path)}}" property="logo">
                </div>
                    @if($event->organiser->enable_organiser_page)
                    <a href="{{route('showOrganiserHome', [$event->organiser->id, Str::slug($event->organiser->name)])}}" title="Organiser Page">
                        {{$event->organiser->name}}
                    </a>
                    @else
                        {{$event->organiser->name}}
                    @endif
                </h3>

                <div property="description">
                    {!! md_to_html($event->organiser->about) !!}
                </div>

                <p>
                    @if($event->organiser->facebook)
                        <a property="sameAs" href="https://fb.com/{{$event->organiser->facebook}}" class="btn btn-facebook">
                            <i class="ico-facebook"></i>&nbsp; @lang("Public_ViewEvent.Facebook")
                        </a>
                    @endif
                        @if($event->organiser->twitter)
                            <a property="sameAs" href="https://twitter.com/{{$event->organiser->twitter}}" class="btn btn-twitter">
                                <i class="ico-twitter"></i>&nbsp; @lang("Public_ViewEvent.Twitter")
                            </a>
                        @endif
                    <button onclick="$(function(){ $('.contact_form').slideToggle(); });" type="button" class="btn btn-primary">
                        <i class="ico-envelop"></i>&nbsp; @lang("Public_ViewEvent.Contact")
                    </button>
                </p>
                <div class="contact_form well well-sm">
                    {{ html()->form('POST', route('postContactOrganiser', ['event_id' => $event->id]))->class('reset ajax')->id('contact-form')->open() }}
                    <h3>@lang("Public_ViewEvent.Contact") <i>{{$event->organiser->name}}</i></h3>
                    <div class="form-group">
                        {{ html()->label(trans("Public_ViewEvent.your_name")) }}
                        {{ html()->text('name')->required()->class('form-control')->placeholder(trans("Public_ViewEvent.your_name")) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Public_ViewEvent.your_email_address")) }}
                        {{ html()->text('email')->required()->class('form-control')->placeholder(trans("Public_ViewEvent.your_email_address")) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label(trans("Public_ViewEvent.your_message")) }}
                        {{ html()->textarea('message')->required()->class('form-control')->placeholder(trans("Public_ViewEvent.your_message")) }}
                    </div>

                    @include('Public.LoginAndRegister.Partials.CaptchaSection')

                    <div class="form-group">
                        <p><input class="btn btn-primary" type="submit" value="@lang('Public_ViewEvent.send_message_submit')"></p>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</section>

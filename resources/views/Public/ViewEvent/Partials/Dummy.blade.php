<form class="online_payment ajax" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post">
    <div class="online_payment">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ html()->label(trans("Public_ViewEvent.card_number"), 'card-number') }}
                    <input required="required" type="text" autocomplete="off" placeholder="**** **** **** ****"
                           class="form-control card-number" size="20" data="number">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    {{ html()->label(trans("Public_ViewEvent.expiry_month"), 'card-expiry-month') }}
                    {{ html()->select('card-expiry-month', options_range(1, 12))->class('form-control card-expiry-month')->attribute('data', 'exp_month') }}
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {{ html()->label(trans("Public_ViewEvent.expiry_year"), 'card-expiry-year') }}
                    {{ html()->select('card-expiry-year', options_range(date('Y'), date('Y') + 10))->class('form-control card-expiry-year')->attribute('data', 'exp_year') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ html()->label(trans("Public_ViewEvent.cvc_number"), 'card-expiry-year') }}
                    <input required="required" placeholder="***" class="form-control card-cvc" data="cvc">
                </div>
            </div>
        </div>

        {{ html()->token() }}

        <input class="btn btn-lg btn-success card-submit" style="width:100%;" type="submit" value="@lang("Public_ViewEvent.complete_payment")">
    </div>
</form>


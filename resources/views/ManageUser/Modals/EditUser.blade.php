<div role="dialog"  class="modal fade" style="display: none;">
    {{ html()->modelForm($user, 'POST', route('postEditUser'))->class('ajax closeModalAfter')->open() }}
        <div class="modal-dialog account_settings">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">
                        <i class="ico-user"></i>
                        @lang("User.my_profile")</h3>
                </div>
                <div class="modal-body">
                    @if(!Auth::user()->first_name)
                        <div class="alert alert-info">
                            <b>
                                @lang("User.welcome_to_app", ["app"=>config('attendize.app_name')])
                            </b><br>
                            @lang("User.after_welcome")
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("User.first_name"), 'first_name')->class('control-label required') }}
                                {{ html()->text('first_name', old('first_name'))->class('form-control') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(trans("User.last_name"), 'last_name')->class('control-label required') }}
                                {{ html()->text('last_name', old('last_name'))->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ html()->label(trans("User.email"), 'email')->class('control-label required') }}
                                {{ html()->text('email', old('email'))->class('form-control ') }}
                            </div>
                        </div>
                    </div>

                    <div class="row more-options">
                        <div class="col-md-12">

                            <div class="form-group">
                                {{ html()->label(trans("User.old_password"), 'password')->class('control-label') }}
                                {{ html()->password('password')->class('form-control') }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("User.new_password"), 'new_password')->class('control-label') }}
                                {{ html()->password('new_password')->class('form-control') }}
                            </div>
                            <div class="form-group">
                                {{ html()->label(trans("User.confirm_new_password"), 'new_password_confirmation')->class('control-label') }}
                                {{ html()->password('new_password_confirmation')->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    <a data-show-less-text='@lang("User.hide_change_password")' href="javascript:void(0);" class="in-form-link show-more-options">
                        @lang("User.change_password")
                    </a>
                </div>
                <div class="modal-footer">
                   {{ html()->button(trans("basic.cancel"))->class("btn modal-close btn-danger")->data('dismiss', 'modal') }}
                   {{ html()->submit(trans("basic.save_details"))->class('btn btn-success pull-right') }}
                </div>
            </div>
        </div>
    {{ html()->closeModelForm() }}
</div>

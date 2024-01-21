<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The password broker implementation.
     *
     * @var PasswordBroker
     */
    protected $passwords;

    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     */
    protected function getEmailSubject(): string
    {
        return isset($this->subject) ? $this->subject : trans('Controllers.your_password_reset_link');
    }

    /**
     * Display the password reminder view.
     */
    public function getRemind(): Response
    {
        return \View::make('Public.LoginAndRegister.ForgotPassword');
    }

    /**
     * Handle a POST request to remind a user of their password.
     */
    public function postRemind(Request $request): RedirectResponse
    {
        $this->validate($request, ['email' => 'required']);

        $response = $this->passwords->sendResetLink($request->only('email'));

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Display the password reset view for the given token.
     */
    public function getReset(?string $token = null): Response
    {
        if (is_null($token)) {
            \App::abort(404);
        }

        return \View::make('Public.LoginAndRegister.ResetPassword')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     */
    public function postReset(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);

            $user->save();

            $this->auth->login($user);
        });

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:
                \Session::flash('message', trans('Controllers.password_successfully_reset'));

                return redirect(route('login'));

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}

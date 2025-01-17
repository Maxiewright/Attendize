<?php

namespace App\Http\Controllers;

use App\Rules\Passcheck;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class UserController extends Controller
{
    /**
     * Show the edit user modal
     */
    public function showEditUser(): View
    {
        $data = [
            'user' => Auth::user(),
        ];

        return view('ManageUser.Modals.EditUser', $data);
    }

    /**
     * Updates the current user
     */
    public function postEditUser(Request $request): JsonResponse
    {
        $rules = [
            'email' => [
                'required',
                'email',
                'unique:users,email,'.Auth::user()->id.',id,account_id,'.Auth::user()->account_id,
            ],
            'password' => [new Passcheck],
            'new_password' => ['min:8', 'confirmed', 'required_with:password'],
            'first_name' => ['required'],
            'last_name' => ['required'],
        ];

        $messages = [
            'email.email' => trans('Controllers.error.email.email'),
            'email.required' => trans('Controllers.error.email.required'),
            'password.passcheck' => trans('Controllers.error.password.passcheck'),
            'email.unique' => trans('Controllers.error.email.unique'),
            'first_name.required' => trans('Controllers.error.first_name.required'),
            'last_name.required' => trans('Controllers.error.last_name.required'),
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validation->messages()->toArray(),
            ]);
        }

        $user = Auth::user();

        if ($request->get('password')) {
            $user->password = Hash::make($request->get('new_password'));
        }

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('Controllers.successfully_saved_details'),
        ]);
    }
}

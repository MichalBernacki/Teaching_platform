<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{

    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.change-password');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'password_old' => 'required|string',
            'password_new' => 'required|string|min:8|confirmed|different:password_old',
        ]);

        // Here we will attempt to change the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $user = Auth::User();
        $currentPassword = $user->password;
        if(Hash::check($request['password_old'], $currentPassword)){
            $user->forceFill([
                'password' => Hash::make($request['password_new']),
            ])->save();

            $status = "Ok";
        }
        else
            $status = "Current password is invalid";
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == "Ok"
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}

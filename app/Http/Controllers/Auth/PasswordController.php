<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['showLoggedInUserPasswordReset', 'loggedInUserReset']]);
    }

    public function showLoggedInUserPasswordReset()
    {
        return view('admin.users.resetpassword');
    }

    public function loggedInUserReset(ResetPasswordRequest $request)
    {
        User::findOrFail($request->user()->id)->resetPassword($request->password);

        return redirect('admin/users');
    }
}

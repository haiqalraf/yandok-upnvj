<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
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
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetFormWithoutToken()
    {
        return view('auth.passwords.reset-auth');
    }

    public function updatePasswordFromOldPassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'password',
            'password' => 'required|confirmed'
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('home')->with("status", "Password Telah Berhasil diubah!");
    }
}

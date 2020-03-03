<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorMail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function index(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();
        if ($user->is_active) {
            return redirect('/');
        }
        return view('auth.verify')->with('userId', $userId);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $user = User::where('id', $request->userId)->first();
        $code = $request->input('code');

        if ($code == $user->two_factor_code && now() < $user->two_factor_expires_at) {
            $user->email_verified_at = now();
            $user->is_active = true;
            $user->account_balance = 100;
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
            $user->save();

            return redirect('/login')->withCookie(\Illuminate\Support\Facades\Cookie::make('username',$user->username));

        } else {
            return redirect('/verify/'.$user->id)->withErrors('Code is expired or invalid. Please try again');
        }
    }

    public function resend(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        if ($user) {
            $user->sendTwoFactorMail();
            return redirect('verify/' . $user->id);
        }
    }
}

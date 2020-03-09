<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorMail;
use App\User;
use Dotenv\Validator;
use http\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function authenticate()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = request()->get('username');
        $password = request()->get('password');
        $remember = request()->get('remember');

        $isValid = $this->validateAuth($username, $password);
        if (!$isValid){
            return redirect('login')->withErrors('Invalid username or password. Please try again');
        }

        $result = Auth::attempt(['username' => $username, 'password' => $password, 'is_active' => true], $remember);

        if (!$result) {
            $user = User::where('username', $username)->first();
            $user->sendTwoFactorMail();

            return redirect('verify/'.$user->id);
        } else {
            return redirect('/');
        }
    }

    private function validateAuth($username, $password)
    {
        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            return true;
        }
    }
}

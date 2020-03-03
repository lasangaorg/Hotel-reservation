<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function register()
    {
        request()->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'g-recaptcha-response' => ['required']
        ]) ;

        $username = request()->input('username');
        $email = request()->input('email');
        $password = request()->input('password');
        $gRecaptchaResponse = request()->input('g-recaptcha-response');
        $secretKey = "6Lcuot0UAAAAAEvC1bB0ywMqBZNK5stav7tInrcO";
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$gRecaptchaResponse;

        $recaptchaResponse = file_get_contents($url);

        $decodedData = json_decode($recaptchaResponse);

        if ($decodedData->success){
            $user = User::create([
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            $user->sendTwoFactorMail();
            return redirect('verify/'.$user->id);
        }else{
            return redirect('register')->withErrors("Invalid captcha");
        }
    }
}

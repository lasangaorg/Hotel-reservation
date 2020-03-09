<?php

namespace App;

use App\Mail\TwoFactorMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'account_balance', 'two_factor_code', 'two_factor_expires_at'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        '2fa_expires_at' => 'datetime'
    ];

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(1000, 9999);
        $this->two_factor_expires_at = now()->addSecond(120);
        $this->save();
    }

    public function sendTwoFactorMail(){
        $this->generateTwoFactorCode();

        $mailData = array(
            'code' => $this->two_factor_code,
            'id' => $this->id
        );

        Mail::to($this->email)->send(new TwoFactorMail($mailData));
    }
}

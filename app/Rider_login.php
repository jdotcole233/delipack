<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rider_login extends Authenticatable
{
    use Notifiable;

    protected $guard = "driver_login";

    protected $primaryKey = "rider_login_id";
    protected $fillable = ['phone_number','password','rider_id','company_id','first_time_sign_in','account_status'];

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
        ];

        public function getStatus(){
            return $this->account_status;
        }
}
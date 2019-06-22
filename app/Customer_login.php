<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customer_login extends Authenticatable
{
    use Notifiable;

    protected $guard = "customer_login";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "customer_login_id";
    protected $fillable = ['phone_number', 'password', 'customerscustomer_id', 'account_status'];

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
    ];

    public function getStatus(){
        return $this->account_status;
    }
}

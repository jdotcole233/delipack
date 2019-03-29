<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider_login extends Model
{
    protected $fillable = ['phone_number', 'password', 'account_status', 'rider_id', 'company_id', 'first_time_sign_in'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_login extends Model
{
    protected $primaryKey = "customer_login_id";
    protected $fillable = ['phone_number', 'password', 'customerscustomer_id', 'account_status'];
}

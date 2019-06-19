<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor_bike extends Model
{
    protected $primaryKey = "bike_id";
    protected $fillable = ['companiescompanies_id', 'brand_name', 'registered_number', 'status', 'date_of_registration', 'date_of_expiry','delete_status'];
}

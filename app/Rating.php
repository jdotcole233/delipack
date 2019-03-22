<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = "rating_id";
    protected $fillable = ['rate_value', 'company_riderscompany_rider_id', 'customerscustomer_id'];

}

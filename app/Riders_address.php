<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riders_address extends Model
{
    protected $primaryKey = "riders_address_id";
    protected $fillable = ['address', 'region', 'city', 'area', 'company_riderscompany_rider_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riders_license extends Model
{
    protected $primaryKey = "license_id";
    protected $fillable = ['company_riderscompany_rider_id', 'company_id', 'License_type', 'License_number', 'Expiry_date', 'date_of_issue'];
}

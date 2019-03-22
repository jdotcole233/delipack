<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Completed_trip extends Model
{
    protected $primaryKey = "completed_trip_id";
    protected $fillable = ['companiescompanies_id', 'company_riderscompany_rider_id', 'ratingsrating_id', 'transactionstransaction_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = "transaction_id";
    protected $fillable = ['company_riderscompany_rider_id', 'customerscustomer_id','company_client_id', 'motor_bikesbike_id' ,'companiescompanies_id', 'destination', 'source', 'payment_mode',  'delivery_status', 'ETA'];
}

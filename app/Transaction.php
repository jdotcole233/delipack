<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = "transaction_id";
    protected $fillable = ['company_riderscompany_rider_id', 'customerscustomer_id', 'companiescompanies_id', 'destination_name', 'source_name', 'item_description', 'delivery_status', 'ETA'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = "payment_id";
    protected $fillable = ['transactionstransaction_id', 'customerscustomer_id', 'transaction_number', 'delivery_charge', 'commission_charge', 'total_charge', 'payment_type'];
}

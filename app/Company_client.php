<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_client extends Model
{
    protected $primaryKey = "company_clients_id";
    protected $fillable = ['client_first_name', 'client_last_name', 'client_primary_number', 'client_alt_number', 'location', 'email_address', 'company_name'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_address extends Model
{
    protected $primaryKey = "company_address_id";
    protected $fillable = ['address', 'region', 'city', 'area', 'companiescompanies_id'];
}

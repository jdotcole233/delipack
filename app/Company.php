<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = "company_id";
    protected $fillable = ["company_name", "company_phone_one", "company_phone_two", "company_logo_path", "company_abbreviation"];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_rider extends Model
{
    protected $primaryKey = "company_rider_id";
    protected $fillable = ['first_name','other_name', 'last_name', 'gender', 'work_phone','personal_phone','assigned_bike', 'imagepath', 'about','delete_status'];
}

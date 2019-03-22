<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riders_assigned_motor_bike extends Model
{
    protected $primaryKey = "rider_motor_bike";
    protected $fillable =['motor_bikesbike_id', 'company_riderscompany_rider_id'];
}

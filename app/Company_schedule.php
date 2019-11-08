<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_schedule extends Model
{
    protected $primaryKey = "company_schedule_id";
    protected $fillable = ['transactionstransaction_id', 'schedule_date','schedule_time'];
}

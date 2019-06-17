<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Android_report extends Model
{
    protected $primaryKey = "android_reports_id";
    protected $fillable = ["report_type","report_message", "android_version", "manufacturer", "customer_id"];
}

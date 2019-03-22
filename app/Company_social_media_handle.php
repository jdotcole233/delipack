<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_social_media_handle extends Model
{
    protected $primaryKey = "socialmedia_handles_id";
    protected $fillable = ['companiescompanies_id', 'twitter_handle', 'facebook_handle', 'instagram_handle'];
}

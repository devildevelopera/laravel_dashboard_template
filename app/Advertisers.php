<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisers extends Model
{
    public $table = "advertisers";
    protected $fillable = ['advertiser_id', 'business_name', 'contact_name', 'contact_phone', 'location_code', 'admin_id'];
    public $timestamps = false;

    public function location() {
        return $this->belongsTo('App\Locations','location_code', 'code');
    }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    public $table= 'ads';
    public $timestamps = false;
    protected $fillable = ['advertiser_id', 'ad_image', 'ad_size', 'ad_target', 'ad_action', 'startdate', 'enddate', 'admin_id'];
    public function advertiser() {
        return $this->belongsTo('App\Advertisers', 'advertiser_id', 'advertiser_id');
    }
}


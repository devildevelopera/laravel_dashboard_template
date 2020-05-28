<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    public $table = "stations";
    protected $fillable = ['station_name', 'latitude', 'longitude', 'location_code', 'address', 'phone', 'photo', 'hours', 'created_at','admin_id'];
    public $timestamps = false;

    public function location(){
        return $this->belongsTo('App\Locations', 'location_code', 'code');
    }
}

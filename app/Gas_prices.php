<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gas_prices extends Model
{
    public $table="Gas_prices";
    protected $fillable = ['station_id','price_regular','price_mid','price_premium','price_diesel','updated'];
    public $timestamps = false;

    public function station() {
        return $this->belongsTo('App\Stations','station_id','id');
    }
}

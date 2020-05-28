<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    //
    public $table = "locations";
    public $timestamps = false;
    public $fillable = ['code', 'name'];

    
}

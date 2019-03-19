<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contacts';
    
    public function organisations(){
      //return $this->belongsTo('App\Organisation');
      return $this->morphedByMany('App\Organisation','contactowner');
    }

    public function taxiservices()
    {
      return $this->morphedByMany('App\TaxiService','contactowner');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contacts';
    
    public function organisation(){
      return $this->belongsTo('App\Organisation');
    }
}

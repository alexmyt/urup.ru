<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $table = 'addresses';
  protected $fillable = ['id','locality','address','lat','lng','description'];

  public function organisations()
  {
    return $this->belongsToMany('App\Organisation');
  }
}

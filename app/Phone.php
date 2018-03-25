<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
  protected $table = 'phones';
  protected $fillable = ['phone','description'];

  public function organisations()
  {
    return $this->morphedByMany('App\Organisation', 'phoneowner');
  }
  
}

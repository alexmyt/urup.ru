<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class TaxiService extends Model
{
  protected $table = 'taxi_services';
  protected $fillable = ['name','description','phones'];

  use Sluggable;
  use SluggableScopeHelpers;

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }

  /**
  * Атрибуты, которые нужно преобразовать в нативный тип.
  *
  * @var array
  */
  protected $casts = [
    'phones' => 'array',
  ];
  //
  
  public function getFormattedPhones($formatString = ''){
    
    
  }
}

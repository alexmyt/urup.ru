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
  

  /**
   * Виртуальные атрибуты
   */
  protected $appends = ['phone_html'];
   
  public function getPhoneHtmlAttribute(){
    $phone = $this->phones[0];
    $phone_rfc = phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966);
    $phone_local = phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
    if (strpos($phone_local,'8 (844) 42') == 0) {
      $phone_local = substr($phone_local,strlen($phone_local)-7,7);
    }
    return "<a href='$phone_rfc'>$phone_local</a>";
  }

  public function getFormattedPhones($formatString = ''){
    
    
  }
}

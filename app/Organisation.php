<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Organisation extends Model
{
  protected $table = 'organisations';
  protected $fillable = ['name','description'];

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
              'source'    => 'name',
              'maxLength' => 90
          ]
      ];
  }
  
  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }
  
  public function contacts()
  {
    return $this->hasMany('App\Contact');
  }

  public function addresses()
  {
    return $this->hasMany('App\Address');
  }

  public function scopeInCategory($query,$categoryId){
    //return $query->with(['categories'=>function($query) use ($categoryId){
    //  return $query->where('category_id','=',$categoryId)->get();
    //  }]);
    return Category::find($categoryId)->organisations;
  }
  
  public function inCategory($categoryId){
    return Category::find($categoryId)->organisations();
  }
}

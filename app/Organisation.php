<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Organisation extends Model
{
  protected $table = 'organisations';
  protected $fillable = ['name','shortName','description','slug'];

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
    return $this->morphToMany('App\Contact','contactowner');
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

  /**
   * List of mostly searched orgs
   */
  public function scopeMostlySearched($query, $count=5, $category=""){
    if($category) {
      return $query->whereHas('categories', function($query) use ($category){
        $query->where('categories.id',$category);
      })->take($count);
    }

    return $query->take($count);
  }

}

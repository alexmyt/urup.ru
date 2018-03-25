<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait; //https://github.com/lazychaser/laravel-nestedset
//use Cartalyst\NestedSets\Nodes\NodeInterface;

class Category extends Model 
{
    use NodeTrait;
    protected $table = 'categories';
    protected $fillable = ['id','name','slug'];

  public function organisations()
  {
    return $this->belongsToMany('App\Organisation');
  }
    
}

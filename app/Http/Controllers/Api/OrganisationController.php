<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Organisation;
use App\Http\Resources\OrganisationResource;
use App\Http\Resources\OrganisationResourceCollection;
use App\Http\Resources\CategoryResourceCollection;
use App\Http\Resources\ContactResourceCollection;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $request = Request::createFromGlobals();
      
      // \DB::enableQueryLog();
      if ($request->has('card')){
        return new OrganisationResourceCollection($this->getMostlySearched($request->input('count',5),$request->input('category')));
      }else{
        $organisations = QueryBuilder::for(Organisation::class)
            ->allowedIncludes(['contacts','addresses','categories'])
            ->allowedFilters([Filter::exact('categories.id'),Filter::exact('id'),'slug'])
            ->paginate();

        return new OrganisationResourceCollection($organisations);
      }
      // \Log::info(\DB::getQueryLog());
    }

    /**
     * List mostly searched organisations with first phone contact
     * 
     * @count - count of organisation to return
     */
    private function getMostlySearched($count=5,$category=''){
      $result = Organisation::mostlySearched($count,$category)
      ->with(
        ['contacts' => function($query) {
          $query->where('contact_type','=','phone');
        }])
        ->get();

      return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

      $organisation = QueryBuilder::for(Organisation::class)
        ->allowedIncludes(['contacts','addresses','categories'])
        ->allowedFilters([
          Filter::exact('id'),
          Filter::exact('categories.id'),
        ])
        ->with(['contacts','addresses','categories']);

      if (is_numeric($slug))
          return new OrganisationResource($organisation->findOrFail($slug));
      elseif (is_string($slug))
          return new OrganisationResource($organisation->whereSlug($slug)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $organisation = Organisation::findOrFail($id);

      $attributes = $request->input('data.attributes');
      $organisation->update($attributes);
      //$organisation->save();

      \Log::info('Organisation update',$request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function relationshipUpdate($id){
      \Log::info('Relationships update',$request->input('data'));
    }

    public function relatedCategories($slug){
      if (is_numeric($slug))
          return new CategoryResourceCollection(Organisation::with('categories')->findOrFail($slug)->categories);
      elseif (is_string($slug))
          return new CategoryResourceCollection(Organisation::with('categories')->whereSlug($slug)->firstOrFail()->categories);
    }

    public function relatedContacts($slug){
      if (is_numeric($slug))
          return new ContactResourceCollection(Organisation::with('contacts')->findOrFail($slug)->contacts);
      elseif (is_string($slug))
          return new ContactResourceCollection(Organisation::with('contacts')->whereSlug($slug)->firstOrFail()->contacts);
    }

  }

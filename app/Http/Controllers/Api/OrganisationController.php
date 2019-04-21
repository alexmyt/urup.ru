<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Organisation;
use App\Http\Resources\OrganisationResource;
use App\Http\Controllers\Controller;

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
      
      if ($request->has('card')){
        return OrganisationResource::collection($this->getMostlySearched($request->input('count',5),$request->input('category')));
      }
    }

    /**
     * List mostly searched organisations with first phone contact
     * 
     * @count - count of organisation to return
     */
    private function getMostlySearched($count=5,$category=''){
      // \DB::enableQueryLog();
      $result = Organisation::mostlySearched($count,$category)
      ->with(
        ['contacts' => function($query) {
          $query->where('contact_type','=','phone');
        }])
        ->get();
      // \Log::info(\DB::getQueryLog());

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

      if (is_numeric($slug))
          return new OrganisationResource(Organisation::with(['contacts','addresses','categories'])->findOrFail($slug));
      elseif (is_string($slug))
          return new OrganisationResource(Organisation::with(['contacts','addresses','categories'])->whereSlug($slug)->firstOrFail());
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
        //
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
}

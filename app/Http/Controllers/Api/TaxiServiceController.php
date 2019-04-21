<?php

namespace App\Http\Controllers\Api;

use App\TaxiService;
use App\Http\Resources\TaxiServiceResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxiServiceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaxiServiceResource::collection(TaxiService::with('contacts')->get());
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
     * @param  \App\TaxiService  $taxiService
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if (is_numeric($slug))
            return new TaxiServiceResource(TaxiService::with('contacts')->findOrFail($slug));
        elseif (is_string($slug))
            return new TaxiServiceResource(TaxiService::with('contacts')->whereSlug($slug)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiService  $taxiService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxiService $taxiService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxiService  $taxiService
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxiService $taxiService)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\TaxiService;
use App\Http\Resources\TaxiServiceResource;
//use App\Http\Resources\TaxiServicesResource;
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
        TaxiServiceResource::withoutWrapping();
        return TaxiServiceResource::collection(TaxiService::with('contacts')->get());
        //$allTaxiServices= TaxiService::all();
        //return new TaxiServicesResource(TaxiService::with('contacts')->get());
        //return view('layouts.pages.transport.taxi.index',['allTaxiServices'=>$allTaxiServices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //return view('layouts.pages.transport.taxi.show',['taxiService'=>TaxiService::findBySlugOrFail($slug)]);
        TaxiServiceResource::withoutWrapping();

        if (is_numeric($slug))
            return new TaxiServiceResource(TaxiService::with('contacts')->findOrFail($slug));
        elseif (is_string($slug))
            return new TaxiServiceResource(TaxiService::with('contacts')->whereSlug($slug)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxiService  $taxiService
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxiService $taxiService)
    {
        //
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

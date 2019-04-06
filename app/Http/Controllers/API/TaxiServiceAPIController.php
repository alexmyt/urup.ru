<?php

namespace App\Http\Controllers\API;

use App\TaxiService;
use App\Http\Resources\TaxiServiceResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxiServiceAPIController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTaxiServices= TaxiService::all();
        return $allTaxiServices;
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
    public function show(TaxiService $taxiService)
    {
        //return TaxiService::whereSlug($slug)->firstOrFail();
	return new TaxiServiceResource($taxiService);
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

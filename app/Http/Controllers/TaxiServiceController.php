<?php

namespace App\Http\Controllers;

use App\TaxiService;
use App\Http\Resources\TaxiServiceResource;
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
        $allTaxiServices= TaxiService::all();
        return view('layouts.pages.transport.taxi.index',['allTaxiServices'=>$allTaxiServices]);
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
        return view('layouts.pages.transport.taxi.show',['taxiService'=>TaxiService::findBySlugOrFail($slug)]);
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

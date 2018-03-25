<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiService;
use App\Organisation;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = array(
            'taxiServices'  => TaxiService::limit(4)->get(),
            'organisations' => Organisation::with(['contacts'=>function($query){$query->where('contact_type','phone');}])->limit(4)->get(),
        );
        
        return view('layouts.pages.index',$viewData);
    }
    
    public function home()
    {
        $this->middleware('auth');
        return view('home');
    }
}

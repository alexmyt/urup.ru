<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = array(
          array('id'=>59,'name'=>'Органы власти','icon'=>'https://maxcdn.icons8.com/office/PNG/40/City/parliament-40.png'),
          array('id'=>57,'name'=>'Структуры ЖКХ','icon'=>'https://maxcdn.icons8.com/office/PNG/40/Household/plumbing-40.png'),
          array('id'=>69,'name'=>'Здравоохранение','icon'=>'https://maxcdn.icons8.com/office/PNG/40/Healthcare/clinic-40.png','subs'=>[]),
          array('id'=>76,'name'=>'Еда и отдых','icon'=>'https://maxcdn.icons8.com/office/PNG/40/City/restaurant-40.png'),
          array('id'=>56,'name'=>'Гостиницы, отели','icon'=>'https://maxcdn.icons8.com/office/PNG/40/City/5_star_hotel-40.png'),
          array('id'=>77,'name'=>'Туристические базы','icon'=>'https://maxcdn.icons8.com/office/PNG/40/Travel/camping_tent-40.png'),

        );
        return view('layouts.pages.business.index')->with('cards',collect($cards));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $viewData = array(
            'organisation'  => Organisation::findBySlugOrFail($slug),
            'phones'        => array(),
            'emails'        => array(),
            'urls'          => array()
        );

        foreach ($viewData['organisation']->contacts as $contact){
            if($contact->contact_type == 'phone'){
                $viewData['phones'][] = $contact->contact;
                continue;
            }

            if($contact->contact_type == 'email'){
                $viewData['emails'][] = $contact->contact;
                continue;
            }

            if($contact->contact_type == 'uri'){
                $link = $contact->contact;

                $viewData['urls'][] = $link;
            }
        }

        return view('layouts.pages.business.show',$viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

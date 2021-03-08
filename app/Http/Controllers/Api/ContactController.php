<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    protected $validation_rules = [
        'data.attributes.contact_type' => 'required',
        'data.attributes.contact' => 'required|phone:RU'
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $request->validate($this->validation_rules);

        $contact = new Contact($request->input('data.attributes'));
        \Log::info('Contact create',$contact->toArray());

        $relationships = $request->input('data.relationships.owner.data')[0];

        if ($relationships['type'] == 'organisations' ){
            $owner = \App\Organisation::findOrFail($relationships['id']);
        }else{
            return response(404)->json(['errors' => [
                'status' => 404,
                'source' => $request->fullUrl(),
                'title'  => 'Owner not found',
                'detail' => 'Contact owner not found:' . $request->input('data.relationships.owner')
            ]]);
        };

        $owner->contacts()->save($contact);

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate($this->validation_rules);
        \Log::info('Contact update',$contact->toArray());
        $contact->update($request->input('data.attributes'));
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

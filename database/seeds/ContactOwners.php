<?php

use Illuminate\Database\Seeder;
use App\Contact;
use App\TaxiService;

class ContactOwners extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactowners')->truncate();
        $contacts = Contact::all();
        foreach ($contacts as $contact){
            $cw = DB::table('contactowners')->insert([
                'contactowner_type' => 'App\Organisation',
                'contactowner_id' => $contact->organisation_id,
                'contact_id' => $contact->id
            ]);
        }

        foreach (App\TaxiService::all() as $taxiService){
            foreach($taxiService->phones as $phone){
                $taxiService->contacts()->create(['contact' => phone($phone,'RU',\libphonenumber\PhoneNumberFormat::E164),'contact_type'=>'phone']);
            }
        }
    }
}

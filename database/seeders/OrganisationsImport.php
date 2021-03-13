<?php

use Illuminate\Database\Seeder;
use App\Organisation;
use App\Category;
use App\Address;
//use Log;

class OrganisationsImport extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        /* TODO:
         * - проверять формат телефона на валидность
         * - проверять адрес сайта на доступность
         */
        
        \DB::table('organisations')->delete();
        \DB::table('contacts')->delete();
        \DB::table('addresses')->delete();
        
        $dadata = new Dadata\Client(new \GuzzleHttp\Client(), [
            'token' => '4ea375d7c6e50cd753fe6407628e81f7c4526b7a',
            'secret' => 'f3264d34087d5fcf6e845c55ea51e0191951f2d6',
        ]);
        \Log::info("DaData balance:".$dadata->getBalance());
        
        
        $query = "SELECT n.nid, n.title as name, b.body_value as description, www.field_site_url_url as www, vk.field_vkontakte_group_url as social1, m.field_map_lat as lat, m.field_map_lon as lon
        FROM node n
        LEFT JOIN field_data_body b ON b.entity_id = n.nid
        LEFT JOIN field_data_field_site_url www ON www.entity_id = n.nid
        LEFT JOIN field_data_field_vkontakte_group vk ON vk.entity_id = n.nid
        LEFT JOIN field_data_field_map m ON m.entity_id = n.nid
        where n.type='organisation'
        ";
        
        $orgs = \DB::connection('urupru')->select($query);
        foreach($orgs as $org){
            $organisation = Organisation::create(['id'=>$org->nid, 'name'=>$org->name, 'description'=>$org->description]);
            $organisation->save();
            
            if(!is_null($org->www))
                $organisation->contacts()->create(['contact_type'=>'web','contact'=>$org->www]);
            if(!is_null($org->social1))
                $organisation->contacts()->create(['contact_type'=>'social','contact'=>$org->social1]);

            $phones = \DB::connection('urupru')->select('SELECT field_phone_value AS phone FROM field_data_field_phone WHERE entity_id = '.$org->nid);
            foreach($phones as $phone){
                $organisation->contacts()->create(['contact_type'=>'phone','contact'=>phone($phone->phone,'RU',\libphonenumber\PhoneNumberFormat::E164)]);
            }
           
            $cats = collect(\DB::connection('urupru')->select('SELECT tid FROM taxonomy_index WHERE nid = '.$org->nid))
                    ->map(function($x){return $x->tid;})
                    ->toArray();
            $organisation->categories()->sync($cats);

            $addresses = \DB::connection('urupru')->select('SELECT field_post_address_locality AS locality, field_post_address_thoroughfare AS street, field_post_address_premise AS flat,
                                                          map.field_map_lat AS lat, map.field_map_lon AS lon
                                                          FROM field_data_field_post_address AS addr
                                                          LEFT JOIN field_data_field_map map USING (entity_id)
                                                          WHERE addr.entity_id = '.$org->nid);
            foreach($addresses as $addr){
                $addres = new Address(['locality'=>$addr->locality, 'address'=> $addr->street . ' ' . $addr->flat, 'lat'=>$addr->lat, 'lon'=>$addr->lon]);
                
                // обработать адрес через DADATA
                if($dadata->getBalance() >= 0.1){
                    $response = $dadata->cleanAddress($addres->locality . ' ' . $addres->address);
                    \Log::info('qc='. $response->qc .' for addres ' . $response->source);
                    if($response->qc == 0 ){
                        $addres->locality = !is_null($response->city_with_type) ? $response->city_with_type : $response->settlement_with_type;
                        $addres->address = $response->street_with_type . ', ' . $response->house_type . '.'. $response->house;

                        if(is_null($addres->lat) || $addres->lat !=50.7967){    // координаты пустые или указывают на центр города
                            \Log::info('qc_geo='. $response->qc_geo .' for addres ' . $response->result);
                            if($response->qc_geo == 0){
                                $addres->lat = $response->geo_lat;
                                $addres->lon = $response->geo_lon;
                            }
                        }
                    }
                }

                $organisation->addresses()->save($addres);
            }
            
        }
    }
}
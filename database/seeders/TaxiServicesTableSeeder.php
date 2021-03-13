<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxiServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxi_services')->delete();
        
        \DB::table('taxi_services')->insert(array (
            0 => 
            array (
                'id' => 2,
                'created_at' => '2017-04-24 20:48:40',
                'updated_at' => '2017-04-30 14:26:24',
                'deleted_at' => NULL,
                'name' => 'Алло',
                'description' => 'Посадка: 30 рублей; Стоимость 1км: 12 рублей.',
                'phones' => '["78444237575"]',
            ),
            1 => 
            array (
                'id' => 3,
                'created_at' => '2017-04-30 10:25:34',
                'updated_at' => '2017-04-30 14:45:10',
                'deleted_at' => NULL,
                'name' => 'Белое',
                'description' => 'Раз-два-три
Вторая строка',
                'phones' => '["88444244344","89270646464","89608745454"]',
            ),
            2 => 
            array (
                'id' => 4,
                'created_at' => '2017-04-30 14:33:40',
                'updated_at' => '2017-04-30 14:33:40',
                'deleted_at' => NULL,
                'name' => 'Лидер',
                'description' => 'По городу от 50 рублей',
                'phones' => '["8444242701","89377280359","89044242301","89093835762"]',
            ),
            3 => 
            array (
                'id' => 5,
                'created_at' => '2017-04-30 14:40:29',
                'updated_at' => '2017-04-30 14:42:15',
                'deleted_at' => NULL,
                'name' => 'Город',
                'description' => 'По городу 30 рублей. Цена за 1км: 10 рублей.',
                'phones' => '["88444246046","89376924434","89026514334","89889414434"]',
            ),
        ));
        
        
    }
}
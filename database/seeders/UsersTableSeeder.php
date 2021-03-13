<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'alexmyt',
                'email' => 'alexmyt1@yandex.ru',
                'password' => '$2y$10$lZBPbZsqxXMAuNbHzNGKCuRjwK..Caw7ZWEBT9llrqxsA4ZWWk5qG',
                'remember_token' => 'DJXTxLkY5x11i22ZX26czua0IAt9cvhACsr0vTc3iKwB4I0zgo2Qev9Zg0Jr',
                'created_at' => '2017-04-16 16:00:04',
                'updated_at' => '2017-04-24 18:16:26',
            ),
        ));
        
        
    }
}
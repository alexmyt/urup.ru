<?php

use Illuminate\Database\Seeder;
use App\Organisation;
use \Cviebrock\EloquentSluggable\Services\SlugService;
//use Log;

class OrganisationsAddSlugs extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        foreach (Organisation::all() as $org){
            if(!$org->slug){
                $org->slug = SlugService::createSlug(Organisation::class,'slug',$org->name);
                $org->save();
            }
        }
    }
}
?>
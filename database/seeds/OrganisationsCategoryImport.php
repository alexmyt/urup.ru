<?php

use Illuminate\Database\Seeder;
use App\Organisation;
use App\Category;

class OrganisationsCategoryImport extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        $query='SELECT td.tid, td.name, th.parent
        FROM taxonomy_term_data td
        LEFT JOIN taxonomy_term_hierarchy th ON td.tid=th.tid
        WHERE td.vid=3
        ORDER BY td.tid, parent';
        
        $cats = \DB::connection('urupru')->select($query);
        foreach($cats as $cat){
          if($cat->parent != 0){
            $parent = Category::find($cat->parent);
            Category::create(['id'=>$cat->tid, 'name'=>$cat->name],$parent);
          }else{
            Category::create(['id'=>$cat->tid, 'name'=>$cat->name]);
          }
        }
    }
}
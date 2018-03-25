<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

use sngrl\SphinxSearch\SphinxSearch;

class SearchController extends Controller
{
    public function search(Request $request){
        if(!$request->has('q')){
            return ['error' => 'No query.'];
        }
        
        $searchTypes = $request->has('st') ? $request->input('st') : 'all';
        
        $results = new Collection;
        foreach(explode(',',$searchTypes) as $searchType){
            if($searchType == 'org' || $searchType == 'all')
                $results = $results->concat($this->searchOrganisations($request));
            
            if($searchType == 'taxi' || $searchType == 'all')
                $results = $results->concat($this->searchTaxi($request));
            
        }
        
        if (!$results->count())
            return ['error' => 'No results found, please try with different keywords.'];
        
        $results = $results->sortByDesc(function ($match) {
            return $match['weight'];
        });
        
        
        return $results->values()->all();
    }
    
    // Organisation search
    private function searchOrganisations(Request $request){

        $sphinx = new SphinxSearch();
        
        $query = $sphinx
                ->search($request->input('q'),'organisationIndex')
                ->limit($request->has('l') ? $request->input('l') : 10)
                ->setFieldWeights(
                    array(
                        'name'  => 15,
                        'description'    => 8,
                        'address' => 6
                    )
                )
                ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
                ->setSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "")
                ->query(true);
        
        if((int)$query['total_found'] == 0)
            return array();
        
        if($request->has('raw'))
            return $query;
        
        $result = array();
        $matchids = array_keys($query['matches']);
        foreach ($matchids as $id){
            $attrs = $query['matches'][$id]['attrs'];
            $result[$id] = array(
                                 'route'    => route('organisation.show',$attrs['slug']),
                                 'title'    => $attrs['name'],
                                 'subtitle' => implode(', ',array($attrs['address'],$attrs['phone'])),
                                 'weight'   => (int)$query['matches'][$id]['weight']
                                 );
        }
        
        return $result;
    }
    
    // Taxi search
    private function searchTaxi(Request $request){

        $sphinx = new SphinxSearch();
        
        $query = $sphinx
                ->search($request->input('q'),'taxiIndex')
                ->limit($request->has('l') ? $request->input('l') : 10)
                ->setFieldWeights(
                    array(
                        'name'  => 15,
                    )
                )
                ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
                ->setSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "")
                ->query();
        
        if((int)$query['total_found'] == 0)
            return array();
        
        if($request->has('raw'))
            return $query;
        
        $result = array();
        $matchids = array_keys($query['matches']);
        foreach ($matchids as $id){
            $attrs = $query['matches'][$id]['attrs'];
            $result[$id] = array(
                                 'route'    => route('taxi.show',$attrs['slug']),
                                 'title'    => $attrs['name'],
                                 'subtitle' => $attrs['phones'],
                                 'weight'   => (int)$query['matches'][$id]['weight']
                                 );
        }
        
        return $result;
    }    
}

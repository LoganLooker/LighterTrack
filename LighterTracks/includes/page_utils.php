<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once('mongo_utils.php');

class Map{

    public function put_pointers($uid=Null){
        $b = new Db_relate('localhost', 27017);
        if(is_null($uid)){
            //echo 'True';
            $locations = $b->get_all_locations();
        }else{
            //echo 'False';
            $locations = $b->get_locations_by_user($uid);
        }
        $zips = array();
        foreach($locations as $lighter){
            foreach($lighter['locations'] as $zip){
                array_push($zips, $zip);
            }
        }
        $cities = $b->get_city_data($zips);
        $out = [];
        foreach($locations as $lighter){
            foreach($lighter['locations'] as $zip){
                foreach($cities as $c){
                    if($c['zip'] == $zip){
                        array_push($out, '[\'<div id=\"infowindow-div\"><b>Location:</b> ' . 
                            $c['name'] . ', ' . $c['state'] . '</div>\', ' . $c['latlong'][0] . 
                            ',' . $c['latlong'][1] . ', ' . $lighter['_id'] . ']');
                    }
                }
            }
        }
        
        echo 'var locations = [' . implode(',', $out) . '];';

    }
}

//$a = new Map();
//$a->put_pointers();
//echo 'it works';
?>

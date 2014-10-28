<?php

class lighter{

    private $address = 'localhost'; //assuming localhost and port
    private $port    = 27017;
    private $c       = null; // collection
    private $id      = null; // lighter id

    public function __construct($addy, $pt){
        $this->address = $addy;
        $this->port = $pt;
        $this->c = new MongoClient($this->address, $this->port)->LighterTrackers->lighters;

        // search if lighter exists, if not, create
        // to-do 
    }
        
    private function insert_self(){
        // insert blank self into db;
    }

    public function update_location(){
        // append a new lat/long into lighter
        // to do 
    }

    public function update_user(){
        // append a new user id into lighter
        // to do
        // create new user? 
    }

    public function get_past_locs(){
        // return array of past locations
        // to do
        $locs = [];
        return $locs;
    }

    public function get_past_users(){
        // return array of past users
        // to do 
        $users = [];
        return $users[];
    }

    public function alter_past_loc($num, $new_loc){
        // alter index past location with supplied loc
        // to do 
    }

    public function alter_past_user($num, $new_user){
        // alter index past user with supplied new user
        // to do
    }

    static function validate_location($location){
        // takes in a lat/long lcation and validates form
        // to do
        return $location
    }



}

?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class lighter{

    private $address = 'localhost'; //assuming localhost and port
    private $port    = 27017;
    private $c       = null; // collection
    private $id      = null; // lighter id
    private $doc     = null;

    public function __construct($addy, $pt, $id){
        $this->address = $addy;
        $this->port = $pt;
        # $client = new MongoClient('mongodb://192.168.1.120:27017');
        $client = new MongoClient();
        $this->c = $client->LighterTracker->lighters;
        $this->id = $id;

        // search if lighter exists, if not, create
        $result = $this->find_self($id);
        if (!$result->count()){
            echo 'instantiating';
            $this->insert_self($id); 
            $this->doc = $this->find_self($id)->getNext();
        }else{
            $this->doc = $result->getNext();
            # echo 'found ' . $this->doc['id'];
        }
    }

    private function find_self($id){
        return $this->c->find(array('id' => $id));
    }
 
    private function insert_self($id){
        // insert blank self into db;
        $this->c->insert(array('id' => $id));
    }

    private function update(){
        //pass
        $this->c->modify(array('id' => $this->doc['id']), $this->doc);
    }
    public function update_location($location){
        // append a new lat/long into lighter
        // to do 
        array_push($this->doc['locations'], $this->validate_location($location));
        $this->update();
    }

    public function update_user(){
        // append a new user id into lighter
        // to do
        array_push($this->doc['users'], user);
        $this->update();
    }

    public function get_past_locs(){
        // return array of past locations
        // to do
        return $this->doc['locations'];
    }

    public function get_past_users(){
        // return array of past users
        // to do 
        return $this->doc['users'];
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
        $location = split('/', $location);
        $lat = floatval($location[0]);
        $long= floatval($location[1]);
        if( $lat and $long ){
            if ($lat[0] >= -90 and $lat[0] <= 90 and $long[1] >= -180 and $long[1] <= 180 ){
                return $location;
            }
        }else{
            echo "Lat/long wrong format";
        }
    }

}

$a = new lighter('localhost', 27017, 1);


class Db_relate{

    private $port = 27017;
    private $address = 'localhost';
    private $db = null;

    public function __construct($addy, $port){
        $this->port = $port;
        $this->address = $addy;
        # $mc= new MongoClient('mongodb://192.168.1.120:27017');
        $mc= new MongoClient();
        $this->db = $mc->LighterTracker;
    }

    public function get_all_lighters($registered = True){
        $c = $this->db->lighers;
        if($registered){
            $pipe = null;
        }else{
            $pipe = null;
        }
        $result = $c->aggregate($pipe); 
        return $result;
    }

    public function get_all_users(){
        return null;
    }

    public function get_all_locations(){
        $c = $this->db->lighters;
        $pipe = array(
            '$match' => array(
                'locations' => 
                    array('$exists' => 'true')
                )
        );
        $result = $c->aggregate($pipe);
        return $result;
    }
}

$b = new Db_relate('localhost', 27017);
$result = $b->get_all_locations();
foreach($result as $doc){
    var_dump($doc);
}
echo 'it works';
?>

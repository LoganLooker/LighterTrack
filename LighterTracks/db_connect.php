<?php
    # connect
    $m = new MongoClient(); #assumes localhost:27017
    
    # selecting the db
    $db = $m->LighterTracks;

    # selecting the collection
    $c = $db->lighters;
    
    var_dump($c->findOne());
?>

<?php

    require_once 'class.citracker.php';

    $user = 'root';
    $pass = 'test12';
    $host = 'localhost:8000/api/1.0/';
    $ct = new Citracker( $user, $pass, $host );

    echo "\nTesting CitrackerAPI client ${user}:${pass}@{$host}\n\n";
    
    echo "Testing publications_list\r\n";
    $ret = $ct->publications_list();
    $publications = $ret;
    foreach( $ret as $cc ){
        echo "\tgot: '{$cc->title}'\r\n";
    }
    
    echo "Testing publications_add\r\n";
    $bibtex = "@book {1079,
title = {Reinventing cinema : movies in the age of media convergence},
year = {2009},
month = {2009},
publisher = {Rutgers University Press},
organization = {Rutgers University Press},
address = {New Brunswick, N.J.},
isbn = {9780813545462},
author = {Tryon, Chuck}
    }";
    $ret = $ct->publications_add($bibtex);
    var_dump($ret);
    $pub_key = $ret[0]->citracker_id;
    
    echo "Testing publications_update\r\n";
    $data = array("key"=>$pub_key,"authors"=>array("John Smith","John Doe"),"title"=>"Reinventing Cinema, Reinvented");
    $ret = $ct->publications_update($data);
    
    echo "Testing publications_delete\r\n";
    $ret = $ct->publications_delete($pub_key);
    var_dump($ret);
    
    if( sizeof($publications)==0){
        
        echo "Can't test citations / monitorings without publications in local db\r\n";
        exit;
    }
    
    $pub_key = $publications[0]->key;
    
    echo "Testing citations_list\r\n";
    $ret = $ct->citations_list($pub_key);
    foreach( $ret as $cc ){
        echo "\tgot: '{$cc->title}'\r\n";
    }
    
    $ret = $ct->citations_list($pub_key,'new','desc');
    foreach( $ret as $cc ){
        echo "\tgot: '{$cc->title}'\r\n";
    }
    
    
    if( sizeof($ret)==0){
        echo "Can't test citations / monitorings without citations in local db\r\n";
        exit;
    }
    
    $cite_key = $ret[0]->key;
    
    echo "Testing citations_set_state";
    $ret = $ct->citations_set_state(array(array("key"=>$cite_key, "state"=>"for_later")));
    var_dump($ret);
    
    echo "Testing citations_update\r\n";
    $data = array("key"=>$cite_key,"authors"=>array("John Smith","John Doe"),"title"=>"Cool title");
    $ret = $ct->citations_update($data);

    echo "Testing monitoring_list\r\n";
    $ret = $ct->monitoring_list();
    var_dump($ret);
    
    echo "Testing monitoring_list_active\r\n";
    $ret = $ct->monitoring_list_active($pub_key);
    var_dump($ret);
    
    echo "Testing monitoring_add\r\n";
    $ret = $ct->monitoring_add($pub_key,'bing','test');
    var_dump($ret);

    echo "Testing monitoring_update\r\n";
    $ret = $ct->monitoring_update($pub_key,'bing','test','test2');
    var_dump($ret);
    
    echo "Testing monitoring_delete\r\n";
    $ret = $ct->monitoring_delete($pub_key,'bing','test2');
    var_dump($ret);    
    
?>
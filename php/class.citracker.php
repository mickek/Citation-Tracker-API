<?php

require_once('class.restapi.php');

class Citracker extends RestApi{
    
    function __construct($username, $password, $host = "http://citation-tracker.com/api/1.0/"){
        $this->host = $host;
        $this->login($username, $password);
    }
    
    /*
     * Authenticated client can ask for a list of all his publications.
     */
    function publications_list(){
        $url = "{$this->host}publications/list.{$this->format}";
        return $this->request($url);
    }
    
    /*
     * Authenticated client can send batches of new publications via HTTP. Each record has an ID provided by the client (Client ID).
     * We may send either bibtex string or array with new publications
     */
    function publications_add($data){
        $url = "{$this->host}publications/add.{$this->format}";
        return $this->request($url, array("post"=>$data));
    }
    
    /*
     * Client sends an updated Publication record. Gets back response with updated publication or 404 error code if no publication was found.
     */
    function publications_update($data){
        $url = "{$this->host}publications/update.{$this->format}";
        return $this->request($url, array("post"=>$data));
    }
    
    /*
     * Deleta a publication that belongs to current user.
     */
    function publications_delete($key){
        $url = "{$this->host}publications/delete.{$this->format}";
        return $this->request($url, array("get"=>array('key'=>$key)));
    }
    
    function citations_list($key, $state = null){
        $url = "{$this->host}citations/list.{$this->format}";
        $data = array('publication_key'=>$key);
        if($state != null) $data['state'] = $state;
        return $this->request($url, array("get"=>$data));
    }

    function citations_set_state($data){
        $url = "{$this->host}citations/set_state.{$this->format}";
        var_dump($data);
        return $this->request($url, array("post"=>$data));   
    }
    
    /*
     * Client sends an updated Citation record. Gets back response or error.
     */
    function citations_update($data){
        $url = "{$this->host}citations/update.{$this->format}";
        return $this->request($url, array("post"=>$data));   
    }
    
    /*
     * Client requests names (strings) and IDS for all possible channels (Ask, Google, Bing, etc.).
     */
    function monitoring_list(){
        $url = "{$this->host}monitoring/list.{$this->format}";
        return $this->request($url);
    }
    
    /*
     * Client requests all active monitors for a particular publication ID.
     * Citation Tracker returns a record for each active monitor, including: Monitor ID, Channel ID, and Stored Query String.
     */
    function monitoring_list_active($key){
        $url = "{$this->host}monitoring/list_active.{$this->format}";
        return $this->request($url, array('get'=>array('publication_key'=>$key)));
    }
    
    /* 
     * Client can send and ʻaddʼ command with a Publication ID, channel name and channel value to add a Monitor.
     */
    function monitoring_add($key, $name, $value){
        $url = "{$this->host}monitoring/add.{$this->format}";
        return $this->request($url, array("post"=>array('publication_key'=>$key, 'value'=>$value, 'name'=>$name)));   
    }
    
    /*
     * Client can send an ʻupdateʼ command to change the query string for an active monitor.
     */
    function monitoring_update($key, $name, $old_value, $new_value){
        $url = "{$this->host}monitoring/update.{$this->format}";
        return $this->request($url, array("post"=>array('publication_key'=>$key, 'old_value'=>$old_value, 'new_value'=>$new_value,'name'=>$name)));   
    }
    
    /* 
     * Client can send a command with a monitoring channel ID to turn a monitor off / delete it.
     */
    function monitoring_delete($key, $name, $value){
        $url = "{$this->host}monitoring/delete.{$this->format}";
        return $this->request($url, array("get"=>array('publication_key'=>$key, 'value'=>$value, 'name'=>$name)));
    }
}
        
?>
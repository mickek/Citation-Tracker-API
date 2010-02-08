<?php
        require_once('class.restapi.php');
        
        class Citracker extends RestApi{
            
            function __construct($username, $password, $host = "http://citation-tracker.com/api/1.0/"){
                
                $this->host = $host;
                $this->login($username, $password);
            }
            
            function publications_list(){
                $url = "{$this->host}publications/list.{$this->format}";
                return $this->request($url);
            }
            
            function publications_add($bibtex){
                $url = "{$this->host}publications/add.{$this->format}";
                return $this->request($url, array("post"=>$bibtex));
            }
            
            function publications_update($data){
                $url = "{$this->host}publications/update.{$this->format}";
                return $this->request($url, array("post"=>$data));
            }
            
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
            
            function citations_update($data){
                $url = "{$this->host}citations/update.{$this->format}";
                return $this->request($url, array("post"=>$data));   
            }
            
            function monitoring_list(){
                $url = "{$this->host}monitoring/list.{$this->format}";
                return $this->request($url);
            }
            
            function monitoring_list_active($key){
                $url = "{$this->host}monitoring/list_active.{$this->format}";
                return $this->request($url, array('get'=>array('publication_key'=>$key)));
            }
            
            function monitoring_add($key, $name, $value){
                $url = "{$this->host}monitoring/add.{$this->format}";
                return $this->request($url, array("post"=>array('publication_key'=>$key, 'value'=>$value, 'name'=>$name)));   
            }
            
            function monitoring_update($key, $name, $old_value, $new_value){
                $url = "{$this->host}monitoring/update.{$this->format}";
                return $this->request($url, array("post"=>array('publication_key'=>$key, 'old_value'=>$old_value, 'new_value'=>$new_value,'name'=>$name)));   
            }
            
            function monitoring_delete($key, $name, $value){
                $url = "{$this->host}monitoring/delete.{$this->format}";
                return $this->request($url, array("get"=>array('publication_key'=>$key, 'value'=>$value, 'name'=>$name)));
            }
    
            
            
            
            
            
            
            
            
            
            
        }
<?php
namespace App\class;


class Inscription{

    private $user;
    private $cours ;
    private $created_at ; 

   

    public function __construct($user,$cours){
      
        $this->user = $user ;
        $this->cours = $cours ;
        $this->created_at = date('Y-m-d');

    }
    
    public function getUser(){
        return $this->user ;
    }
    public function getCours(){
        return $this->cours ;
    }
    public function getCreated_at(){
        return $this->created_at ;
    }
}
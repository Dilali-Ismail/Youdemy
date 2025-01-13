<?php
namespace App\class;

class categorie{

    private $id ;
    private $name ;
    private $created_at ;
    private $updated_at ;
    private $deleted_at ;
   

    public function __construct($id,$name,$updated_at = '',$deleted_at = ''){
      
        $this->id = $id ;
        $this->name = $name ;
        $this->created_at = date('Y-m-d') ;
        $this->updated_at = $updated_at ;
        $this->deleted_at = $deleted_at ;
    }
    
    public function getId(){
        return $this->id ;
    }
    public function getName(){
        return $this->name ;
    }
    public function getCreated_at(){
        return $this->created_at ;
    }
    public function getUpdated_at(){
        return $this->updated_at ;
    }
    public function getDeleted_at(){
        return $this->deleted_at ;
    }
}

?>
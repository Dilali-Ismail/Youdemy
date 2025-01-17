<?php

namespace App\Controller;

use App\model\BaseModel;
use App\model\CoursModel;

class CoursController 
{
  private $Coursmodel ;
   
  public function __construct(){
    $this->Coursmodel = new CoursModel();
  }

    public function getCours(){
      $getAllcours = $this->Coursmodel->getAll();
      return  $getAllcours ;
    }

    public function createCoursC($title, $description, $content,$categorie_id,$tags){

      $createCours = $this->Coursmodel->create($title, $description, $content,$categorie_id,$tags);
      return  $createCours ;
    }

    public function editCoursC( $id,$args, $description, $content,$categorie_id,$tags){

      $editeCours = $this->Coursmodel->edit($args, $id, $description , $content , $categorie_id , $tags );
      return  $editeCours ;
    }


    public function deletCoursC($id){
      
      $deletCours =  $this->Coursmodel->delete($id);
      return $deletCours ;
      
  }


}








?>
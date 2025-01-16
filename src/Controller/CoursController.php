<?php

namespace App\Controller;
use App\model\CoursModel;

class CoursController
{
  private $Coursmodel ;
   

    public function getCours(){
      $this->Coursmodel = new CoursModel();
      $getAllcours = $this->Coursmodel->getCoursM();
      return  $getAllcours ;
    }

    public function createCoursC($title, $description, $content,$categorie_id,$tags){
      $this->Coursmodel = new CoursModel();
      $createCours = $this->Coursmodel->createCoursM($title, $description, $content,$categorie_id,$tags);
      return  $createCours ;
    }

    public function deletCoursC($id){
     
      $this->Coursmodel = new CoursModel();
      $deletCours =  $this->Coursmodel->deletCoursM($id);
      return $deletCours ;
      
  }


}








?>
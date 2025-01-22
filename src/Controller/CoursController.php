<?php

namespace App\Controller;
use App\model\CoursModel;

class CoursController 
{
  private $Coursmodel ;
   
  public function __construct(){
    $this->Coursmodel = new CoursModel();
  }

  public function getCours($page, $limit ) {
    $offset = ($page - 1) * $limit;

    // Récupérer les cours pour la page
    $cours = $this->Coursmodel->getAll($limit, $offset);

    // Récupérer le total des cours
    $totalCourses = $this->Coursmodel->getTotalCourses();
    $totalPages = ceil($totalCourses / $limit);

    // Retourner les données
    return [
        'courses' => $cours,                 
        'totalPages' => $totalPages     
    ];
}

public function searchtCours($search ) {
 
   return $this->Coursmodel->search($search);
}

    public function createCoursC($title,$coverture , $description, $content,$categorie_id,$tags,$author){

      $createCours = $this->Coursmodel->create($title ,$coverture , $description, $content,$categorie_id,$tags,$author);
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

  

   
  public function getCoursByAuthor($Author){
    $getAllcoursByAuth = $this->Coursmodel->getAllBYAuthor($Author);
    return  $getAllcoursByAuth ;
  }

  public function inscriptionCours($UserId){
    $CoursInscription = $this->Coursmodel->inscriptionCours($UserId);
    return  $CoursInscription ;
  }
  
  
  public function Inscripter($userId,$CoursId){
  $Inscripter =  $this->Coursmodel->Inscripter($userId,$CoursId);
  return $Inscripter ;
  }

  public function InscripterOff($CoursId){
    $Inscripter =  $this->Coursmodel->InscripterOff($CoursId);
    return $Inscripter ;
    }

  public function NbrCours($Author){
    $Nbr =  $this->Coursmodel->NbrCours ($Author);
    return $Nbr ;
  }

  //statistique
  public function TotalCours(){
    $ToTalCours =  $this->Coursmodel->getTotalCourses();
    return $ToTalCours ;
  }

  public function CourAvecPlusEtudiants(){
    $CoursUsers =  $this->Coursmodel->CourAvecPlusEtudiants();
    return  $CoursUsers ;
  }

  public function RepartitionParCategorie(){
    $Repartition =  $this->Coursmodel->RepartitionParCategorie();
    return  $Repartition ;
  }

  public function TopTroisEnsignants(){
    $Repartition =  $this->Coursmodel->TopTroisEnsignants();
    return  $Repartition ;
  }

  public function UsersInEveryCours($cour){
    $Repartition =  $this->Coursmodel->UsersInEveryCours ($cour);
    return  $Repartition ;
  }


}








?>
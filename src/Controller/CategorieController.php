<?php

namespace App\Controller ;
use App\model\Categoriemodel;

class CategorieController
{
  private $Categoeriemodel ;

    public function getCategorieC(){
      $this->Categoeriemodel = new Categoriemodel();
      $getAllcategories = $this->Categoeriemodel->getCategorieM();
      return  $getAllcategories ;
    }

   public function createCategorieC($CategorieName){
    $this->Categoeriemodel = new Categoriemodel();
    $creat = $this->Categoeriemodel ->createCategorieM($CategorieName);
    return $creat ;
   }

   public function editCategorieC($CategorieName,$id){
    $this->Categoeriemodel = new Categoriemodel();
    $update = $this->Categoeriemodel-> editCategorieM($CategorieName,$id);
    return $update ;
   }
   public function deletCategorieC($id){
    $this->Categoeriemodel = new Categoriemodel();
    $delet = $this->Categoeriemodel->deletCategorieM($id);
    return $delet ;
   }
}
?>
<?php

namespace App\Controller ;
use App\model\Categoriemodel;

class CategorieController
{
  private $Categoeriemodel ;

     public function __construct()
     {
      $this->Categoeriemodel = new Categoriemodel();
     }

    public function getCategorieC(){
    
      $getAllcategories = $this->Categoeriemodel-> getAll();
      return  $getAllcategories ;

    }

   public function createCategorieC($CategorieName){

    $creat = $this->Categoeriemodel ->create($CategorieName);
    return $creat ;

   }

   public function editCategorieC($CategorieName,$id){

    $update = $this->Categoeriemodel->edit($CategorieName,$id);
    return $update ;

   }
   public function deletCategorieC($id){

    $delet = $this->Categoeriemodel->delete($id);
    return $delet ;
    
   }
}
?>
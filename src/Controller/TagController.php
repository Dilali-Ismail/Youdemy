<?php
namespace App\Controller ;
use App\model\Tagmodel;

class TagController
{
  private $Tagmodel ;
   

    public function getTags(){
      $this->Tagmodel = new Tagmodel();
      $getAlltags = $this->Tagmodel->getTags();
      return  $getAlltags ;
    }

   public function createTagC($TagName){
    $this->Tagmodel = new Tagmodel();
    $Tag = $this->Tagmodel->createTagM($TagName);
    return $Tag ;
   }

   public function editTagC($TagName,$id){
    $this->Tagmodel = new Tagmodel();
    $update = $this->Tagmodel->editTagM($TagName,$id);
    return $update ;
   }
   public function deletTagC($id){
    $this->Tagmodel = new Tagmodel();
    $delet = $this->Tagmodel->deletTagM($id);
    return $delet ;
   }
}
?>
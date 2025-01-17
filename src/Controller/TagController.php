<?php
namespace App\Controller ;
use App\model\Tagmodel;

class TagController
{
  private $Tagmodel ;
  public function __construct()
  {
    $this->Tagmodel = new Tagmodel();
  }
   

    public function getTags(){

      $getAlltags = $this->Tagmodel->getAll();
      return  $getAlltags ;

    }

   public function createTagC($TagName){

    $Tag = $this->Tagmodel-> create($TagName);
    return $Tag ;
    
   }

   public function editTagC($TagName,$id){

    $update = $this->Tagmodel->edit($TagName,$id);
    return $update ;

   }
   public function deletTagC($id){

    $delet = $this->Tagmodel->delete($id);
    return $delet ;

   }
}
?>
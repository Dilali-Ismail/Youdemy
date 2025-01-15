<?php

namespace App\class;

class Cours{
 private $id ;
 private $title ;
 private $description ;
 private $content ;
 private array $tags ;
 private categorie $categorie ;

public function getId(){
    return $this->id ;
}
public function getTitle(){
    return $this->title ;
}
public function getDescription(){
    return $this->description ;
}
public function getContent(){
    return $this->content ;
}
public function getTags(){
    return $this->tags ;
}
public function getCategorie(){
    return $this->categorie ;
}


public function __construct($id ,$title , $description , $content , $tags , $categorie )
{
     $this->id = $id ;
     $this->title = $title ;
     $this->description = $description ;
     $this->content = $content ;
     $this->tags = $tags ;
     $this->categorie = $categorie ;
    
}

}
?>
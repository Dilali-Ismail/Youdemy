<?php
namespace App\model;
use App\config\Connexion ;
use PDO ;
use PDOException ;
use App\class\categorie;
class Categoriemodel{

private $con ;


public function __construct(){
 $this->con = Connexion::connection();
}

public function getCategorieM(){
    $query = "SELECT Categories.id , Categories.name , Categories.created_at , Categories.updated_at from Categories where Categories.deleted_at IS NULL";
    $stmt = $this->con->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(!$result){
return null ;
}
else{
    return $result ;
}
}

public function createCategorieM($CategorieName){
    try{
        $query = "INSERT INTO Categories (name, created_at) VALUES ( :CategorieName , CURRENT_DATE) ";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':CategorieName',$CategorieName);
        $stmt->execute();

     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     if($row)
     return new categorie($row['id'],$row['name']);
    }
    catch (PDOException $e) {
    
        error_log("Error creating Categorie: " . $e->getMessage());
        return false;
    }
    
    
    }
    
    public function editCategorieM($CategorieName,$id){
    
        try{
        
            $query = "UPDATE Categories SET Categories.name = :CategorieName , Categories.updated_at = CURRENT_DATE WHERE Categories.id = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id',$id);
            $stmt->bindParam(':CategorieName',$CategorieName);
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row)
            return new categorie($row['id'],$row['name']);
        }
        catch (PDOException $e) {
        
            error_log("Error updating Categorie: " . $e->getMessage());
            return false;
        }
        
    }
    
    public function deletCategorieM($id){
    
        try{
        
            $query = "UPDATE Categories SET Categories.deleted_at = CURRENT_DATE  WHERE Categories.id = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
        
          return $this->con->lastInsertId();
        }
        catch (PDOException $e) {
        
            error_log("Error Deleting categorie: " . $e->getMessage());
            return false;
        }
        
    }
    

}
?>
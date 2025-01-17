<?php
namespace App\model;
use PDO ;
use PDOException ;
use App\class\categorie;
class Categoriemodel extends BaseModel{


public function __construct(){
 parent::__construct('Categories');
}

public function getAll(){
    $query = "SELECT Categories.id , Categories.name , Categories.created_at , Categories.updated_at from $this->table_name where Categories.deleted_at IS NULL";
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

public function create($args){
    try{
        $query = "INSERT INTO $this->table_name (name, created_at) VALUES ( :CategorieName , CURRENT_DATE) ";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':CategorieName',$args);
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
    
    public function edit($args,$id){
    
        try{
        
            $query = "UPDATE Categories SET Categories.name = :CategorieName , Categories.updated_at = CURRENT_DATE WHERE Categories.id = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id',$id);
            $stmt->bindParam(':CategorieName',$args);
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
    
    public function delete($id){
    
        try{
        
            $query = "UPDATE $this->table_name SET Categories.deleted_at = CURRENT_DATE  WHERE Categories.id = :id";
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
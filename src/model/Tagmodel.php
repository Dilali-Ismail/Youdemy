<?php
namespace App\model;
use App\Config\Connexion ;
use App\class\Tag;
use PDO ;
use PDOException ;

class Tagmodel{

private $con ;


public function __construct(){

$this->con = Connexion::connection();

}

public function getTags(){
    $query = "SELECT Tags.id , Tags.title , Tags.created_at , Tags.updated_at  from Tags where Tags.deleted_at IS NULL ORDER BY Tags.id DESC ";
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

public function createTagM($TagName){
 
try{
    $query = "INSERT INTO Tags (title, created_at) VALUES ( :TagName , CURRENT_DATE) ";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':TagName',$TagName);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Tag($row['id'],$row['title']);
}
catch (PDOException $e) {

    error_log("Error creating tag: " . $e->getMessage());
    return false;
}

}

public function editTagM($TagName,$id){

    try{
        
        $query = "UPDATE Tags SET Tags.title = :TagName , Tags.updated_at = CURRENT_DATE WHERE Tags.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':TagName',$TagName);
        $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($row)
       return new Tag($row['id'],$row['title']);

    }
    catch (PDOException $e) {
    
        error_log("Error updating tag: " . $e->getMessage());
        return false;
    }
    
}

public function deletTagM($id){

    try{
    
        $query = "UPDATE Tags SET Tags.deleted_at = CURRENT_DATE  WHERE Tags.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    
    return $this->con->lastInsertId();
    }
    catch (PDOException $e) {
    
        error_log("Error Deleting tag: " . $e->getMessage());
        return false;
    }
    
}

}
?>
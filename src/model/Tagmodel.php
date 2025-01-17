<?php
namespace App\model;
use App\class\Tag;
use PDO ;
use PDOException ;

class Tagmodel extends BaseModel{



public function __construct(){
    parent::__construct("Tags");

}

public function getAll(){
    $query = "SELECT Tags.id , Tags.title , Tags.created_at , Tags.updated_at  from $this->table_name where Tags.deleted_at IS NULL ORDER BY Tags.id DESC ";
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
    $query = "INSERT INTO $this->table_name (title, created_at) VALUES ( :TagName , CURRENT_DATE) ";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':TagName',$args);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row)
    return new Tag($row['id'],$row['title']);
}
catch (PDOException $e) {

    error_log("Error creating tag: " . $e->getMessage());
    return false;
}

}

public function edit($args,$id){

    try{
        
        $query = "UPDATE $this->table_name SET Tags.title = :TagName , Tags.updated_at = CURRENT_DATE WHERE Tags.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':TagName',$args);
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

public function delete($id){

    try{
    
        $query = "UPDATE $this->table_name SET Tags.deleted_at = CURRENT_DATE  WHERE Tags.id = :id";
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
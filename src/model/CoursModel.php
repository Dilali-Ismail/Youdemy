<?php
namespace App\model ;
use App\Config\Connexion ;
use App\class\Cours ;
use App\class\categorie ;
use App\class\Tag ;
use PDO ;
use PDOException ;


class CoursModel{

    private $con ;


public function __construct(){

$this->con = Connexion::connection();
}


public function getCoursM(){
    $query = "SELECT Cours.id, Cours.title , Cours.description , Cours.content , Categories.name ,
              GROUP_CONCAT(Tags.title) as tags , GROUP_CONCAT(Tags.id) as Tags_id 
              from
               Cours 
              inner join
               Categories on Categories.id = Cours.cat_id
              inner join
               CoursTags on Cours.id = CoursTags.cours_id
              inner join
               Tags on Tags.id = CoursTags.tag_id 
              where
               Cours.deleted_at is NULL 
              GROUP BY Cours.id, Cours.title , Cours.description , Cours.content , Categories.name ";

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

public function createCoursM($title, $description, $content,$categorie_id,$tags) {
    try {
    
        $query = "INSERT INTO Cours (title, description, content, cat_id ,isArchive, created_at , updated_at , deleted_at)
                  VALUES (:title, :description, :content, :categorie_id,  NULL , CURRENT_DATE , NULL , NULL)";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content); 
        $stmt->bindParam(':categorie_id', $categorie_id);
       
        $stmt->execute();
         //i should return an object cours 
        $cours_id =  $this->con->lastInsertId();

        $querytags = "INSERT INTO CoursTags (tag_id, cours_id) Values(:tag_id,:cours_id)";
        $tagstmt = $this->con->prepare($querytags);

        foreach($tags as $tag){
            $tagstmt->bindParam(':cours_id',$cours_id);
            $tagstmt->bindParam(':tag_id',$tag);
            $tagstmt->execute();
        }
        return $cours_id ;
       
    } catch (PDOException $e) {
        echo "Error creating cours: " . $e->getMessage();
        error_log("Error creating cours: " . $e->getMessage());
        return false;
    }
}

}
?>
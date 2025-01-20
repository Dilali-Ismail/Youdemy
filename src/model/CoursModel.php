<?php
namespace App\model ;
use App\Config\Connexion ;
use App\class\Cours ;
use App\class\categorie ;
use App\class\Tag ;
use PDO ;
use PDOException ;


class CoursModel extends BaseModel{


public function __construct(){

parent::__construct('Cours');

}


public function getAll($limit ='', $offset =''){
    $query = "SELECT Cours.id, Cours.title , Cours.description , Cours.content ,User.name as author , Categories.name ,Categories.id as CategiId ,
              GROUP_CONCAT(Tags.title) as tags , GROUP_CONCAT(Tags.id) as Tags_id 
              from
               $this->table_name 
              inner join
               Categories on Categories.id = Cours.cat_id
                inner join
               User on User.id = Cours.author
              inner join
               CoursTags on Cours.id = CoursTags.cours_id
              inner join
               Tags on Tags.id = CoursTags.tag_id 
              where
               Cours.deleted_at is NULL 
               GROUP BY Cours.id, Cours.title, Cours.description, Cours.content, Categories.name 
                      LIMIT :limit OFFSET :offset" ; 
                $stmt = $this->con->prepare($query);  
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // $courses = [];
                if(!$result){
                return  [];
                }
                else{
                            return $result ;
                            // foreach ($result as $row) {
                            //     $tags = explode(',', $row['tags']);
                            //     $categorie = new categorie($row['cat_id'], $row['name']); 
                            //     $courses[] = new Cours($row['id'], $row['title'], $row['description'], $row['content'], $tags, $categorie);
                            // }

                            // return $courses;
                        }
            }

public function create($title, $description ='', $content ='',$categorie_id ='',$tags = [],$author='') {
    try {
    
        $query = "INSERT INTO $this->table_name (title, description, content, cat_id ,isArchive, created_at , updated_at , deleted_at,Cours.author)
                  VALUES (:title, :description, :content, :categorie_id,  NULL , CURRENT_DATE , NULL , NULL,:Author)";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content); 
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':Author', $author);
       
        $stmt->execute();
         
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

public function edit($args, $id, $description = '', $content = '', $categorie_id = '', $tags = []) {
    try {
       
        $query = "UPDATE $this->table_name  SET title = :title,  description = :description,  content = :content,  cat_id = :categorie_id, updated_at = CURRENT_DATE WHERE id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $args);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->execute();
      
        $deleteTagsQuery = "DELETE FROM CoursTags WHERE cours_id = :id";
        $deleteStmt = $this->con->prepare($deleteTagsQuery);
        $deleteStmt->bindParam(':id', $id);
        $deleteStmt->execute();


        $queryTags = "INSERT INTO CoursTags (tag_id, cours_id) VALUES (:tag_id, :cours_id)";
        $tagStmt = $this->con->prepare($queryTags);

        foreach ($tags as $tag) {
            $tagStmt->bindParam(':cours_id', $id);
            $tagStmt->bindParam(':tag_id', $tag);
            $tagStmt->execute();
        }

        return true; 

    } catch (PDOException $e) {
        echo "Error updating cours: " . $e->getMessage();
        error_log("Error updating cours: " . $e->getMessage());
        return false;
    }
}


public function delete($id){
    try{

        $query = "UPDATE $this->table_name SET Cours.deleted_at = CURRENT_DATE  WHERE Cours.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    
    return $this->con->lastInsertId();
    }
    catch (PDOException $e) {
        echo "Error deleting cours: " . $e->getMessage();
        error_log("Error Deleting cours: " . $e->getMessage());
        return false;
    }
}

public function getAllBYAuthor($Author){
    $query = "SELECT Cours.id, Cours.title , Cours.description , Cours.content ,Cours.author , Categories.name ,Categories.id as CategiId ,
              GROUP_CONCAT(Tags.title) as tags , GROUP_CONCAT(Tags.id) as Tags_id 
              from
               $this->table_name 
              inner join
               Categories on Categories.id = Cours.cat_id
                inner join
               User on User.id = Cours.author 
              inner join
               CoursTags on Cours.id = CoursTags.cours_id 
              inner join
               Tags on Tags.id = CoursTags.tag_id 
              where
              Cours.author = $Author and Cours.deleted_at is NULL 
              GROUP BY Cours.id, Cours.title , Cours.description , Cours.content , Categories.name ";

    $stmt = $this->con->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $courses = [];
if(!$result){
return null ;
}
else{
    return $result ;
    // foreach ($result as $row) {
    //     $tags = explode(',', $row['tags']);
    //     $categorie = new categorie($row['cat_id'], $row['name']); 
    //     $courses[] = new Cours($row['id'], $row['title'], $row['description'], $row['content'], $tags, $categorie);
    // }

    // return $courses;
}
}

public function inscriptionCours($UserId){
    
    $query = "SELECT Cours.id, Cours.title , Cours.description , Cours.content, Cours.author ,User.name as Auth, Categories.name ,Categories.id as CategiId 
              from Cours
              inner join Inscription on Inscription.cour_id = Cours.id
              inner join Categories on Categories.id = Cours.cat_id 
              inner join User on User.id = Cours.author 
              where Cours.deleted_at is NULL and user_id = $UserId
              GROUP BY Cours.id, Cours.title , Cours.description , Cours.content , Categories.name ";

  $stmt = $this->con->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  if(!$result){
    return null ;
    }
    else{
        return $result ;
        // foreach ($result as $row) {
        //     $tags = explode(',', $row['tags']);
        //     $categorie = new categorie($row['cat_id'], $row['name']); 
        //     $courses[] = new Cours($row['id'], $row['title'], $row['description'], $row['content'], $tags, $categorie);
        // }
    
        // return $courses;
    }
}

public function Inscripter($userId,$CoursId){
    try{
        $query ="INSERT Into Inscription (user_id,cour_id,created_at) VALUES (:UserID,:CoursID,CURRENT_DATE)";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':UserID', $userId);
        $stmt->bindParam(':CoursID', $CoursId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row)
        return $row;
    }
   catch (PDOException $e) {

        error_log("Error Inscription: " . $e->getMessage());
        return false;
    }

}

public function InscripterOff($CoursId){
    try{
        $query ="delete from Inscription where Inscription.cour_id = :CoursID ";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':CoursID', $CoursId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row)
        return $row;
    }
   catch (PDOException $e) {

        error_log("Error Inscription: " . $e->getMessage());
        return false;
    }

}

public function NbrCours ($Author){
    try{
    $query = "SELECT COUNT(*) as NbrCours from `Cours` where Cours.author = :AuthorID and deleted_at is NULL ";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':AuthorID', $Author);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   if($row)
    return $row;
    }

    catch (PDOException $e) {

        error_log("Error : " . $e->getMessage());
        return false;
    }

}

public function NbrInscription ($Author){
    try{
         $query = "SELECT COUNT(*) as NbrCours from `Cours` where Cours.author = :AuthorID and deleted_at is NULL ";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':AuthorID', $Author);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   if($row)
    return $row;
    }

    catch (PDOException $e) {

        error_log("Error : " . $e->getMessage());
        return false;
    }
}

public function getTotalCourses(){
    $query = "SELECT COUNT(*) FROM Cours WHERE deleted_at IS NULL ";
     $stmt = $this->con->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn();
}


public function search($search){
    $query = "SELECT Cours.id, Cours.title , Cours.description , Cours.content ,User.name as author , Categories.name ,Categories.id as CategiId ,
              GROUP_CONCAT(Tags.title) as tags , GROUP_CONCAT(Tags.id) as Tags_id 
              from
               $this->table_name 
              inner join
               Categories on Categories.id = Cours.cat_id
                inner join
               User on User.id = Cours.author
              inner join
               CoursTags on Cours.id = CoursTags.cours_id
              inner join
               Tags on Tags.id = CoursTags.tag_id 
              where
               Cours.deleted_at is NULL AND Cours.title LIKE :search OR Cours.description LIKE  :search
              GROUP BY Cours.id, Cours.title, Cours.description, Cours.content, Categories.name " ; 
               
    $stmt = $this->con->prepare($query);

     if (!empty($search)) {
                 $searchParam = "%$search%";
                 $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
            }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $courses = [];
if(!$result){
  return  [];
}
else{
    return json_encode($result);
    // foreach ($result as $row) {
    //     $tags = explode(',', $row['tags']);
    //     $categorie = new categorie($row['cat_id'], $row['name']); 
    //     $courses[] = new Cours($row['id'], $row['title'], $row['description'], $row['content'], $tags, $categorie);
    // }

    // return $courses;
}



}
















}
?>
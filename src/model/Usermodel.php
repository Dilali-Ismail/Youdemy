<?php
namespace App\model ;
use App\class\Role;
use App\class\User ;
use PDO ;
use PDOException;
use App\config\Connexion ;

 class Usermodel{
   private $con ;
   public function __construct()
   {
    $this->con = Connexion::connection();
   }


  public function getAllusers(){
     $querry = " SELECT User.id  , User.name , User.email ,Roles.name as role_title , User.isActive
               from User INNER JOIN Roles on Roles.id = User.role_id where User.role_id = 2 and User.deleted_at IS NULL ";
     $stmt = $this->con->prepare($querry) ;
     $stmt->execute(); 
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     if(!$result){
     return null ;
     }
     else{
        echo 'error from database';
         return $result ;
     }

  }

    public function findUserByEmailAndPassword($email, $password) {
    $querry = "SELECT User.id, User.name, User.email, User.password, User.isActive, User.suspended, 
                      User.role_id, Roles.id as role_id, Roles.name as role_name
               FROM User 
               INNER JOIN Roles ON Roles.id = User.role_id 
               WHERE User.email = :email";
    $stmt = $this->con->prepare($querry);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return ["status" => "error", "message" => "Email non trouvé"];
    }

    if ($row['isActive'] == 0) {
        return ["status" => "error", "message" => "Votre compte n'est pas activé"];
    }

    if ($row['suspended'] == 1) {
        return ["status" => "error", "message" => "Votre compte est suspendu"];
    }

    if (password_verify($password, $row['password'])) {
        $role = new Role($row['role_id'], $row['role_name']);
        $user = new User($row['id'], $row['name'], $row['email'], $row['password'], $role);
        return ["status" => "success", "user" => $user];
    } else {
        return ["status" => "error", "message" => "Mot de passe incorrect"];
    }
}


    public function createUserM($name, $email, $password, $role)
    {
        $hachingPassword = password_hash($password,PASSWORD_BCRYPT);
        $photo = "photo.jpg";
        try {
            $query = "INSERT INTO User (role_id, name, email, password, photo, isActive, suspended , deleted_at) VALUES (:role , :name,:email , :password ,:photo, NULL ,0,NULL )";
            $stmt = $this->con->prepare($query);         
            $stmt->bindParam(":role", $role);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hachingPassword);
            $stmt->bindParam(":photo",  $photo);
           

            $stmt->execute();
            // i should return an user object but how ?
            return $this->con->lastInsertId();

            
        } catch (PDOException $e) {
            echo "Error add user: " . $e->getMessage();
            error_log("Error add user: " . $e->getMessage());
            return false;
        }
    }

    public function activerUserM($id){
        try{
        $query = "UPDATE User SET User.isActive = 1 WHERE User.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->con->lastInsertId();
        }
        catch (PDOException $e) {
            echo "not activing user";
            error_log("Error activing user: " . $e->getMessage());
            return false;
        }
       }

       public function susPUserM($id){
        try{
        $query = "UPDATE User SET User.suspended = 1 WHERE User.id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->con->lastInsertId();
        }
        catch (PDOException $e) {
            echo "not activing user";
            error_log("Error suspension user: " . $e->getMessage());
            return false;
        }
       }


       public function deletUserM($id){

        try{
        
            $query = "UPDATE User SET User.deleted_at = CURRENT_DATE  WHERE User.id = :id";
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
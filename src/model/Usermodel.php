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

    public function findUserByEmailAndPassword($email,$password){
    $querry = "SELECT User.id  , User.name , User.email , User.password , User.role_id , Roles.id as role_id, Roles.name as role_name
               from User INNER JOIN Roles on Roles.id = User.role_id where User.email = :email";
    $stmt = $this->con->prepare($querry) ;
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        return null;
    }
    else{
       if(password_verify($password,$row['password'])) {
        $role = new Role($row['role_id'],$row['role_name']);
        $user = new User($row['id'],$row['name'],$row['email'],$row['password'],$role);
        return $user ;
       }
        
    }
    }

    public function createUserM($name, $email, $password, $role)
    {
        $hachingPassword = password_hash($password,PASSWORD_BCRYPT);
        $photo = "photo.jpg";
        try {
            $query = "INSERT INTO User (role_id, name, email, password, photo, isActive, deleted_at) VALUES (:role , :name,:email , :password ,:photo, NuLL ,NULL )";
            
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
    
 }
?>
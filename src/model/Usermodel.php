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
    $db = new Connexion();
    $this->con = $db->connection();
   }

    public function findUserByEmailAndPassword($email,$password){
    $querry = "SELECT user.id  , user.name , user.email , user.password , role.id as role_id ,role.title as role_title
              from user INNER JOIN role on role.id = user.role where user.email = :email";
    $stmt = $this->con->prepare($querry) ;
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        return null;
    }
    else{
       if(password_verify($password,$row['password'])) {
        $role = new Role($row['role_id'],$row['role_title']);
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
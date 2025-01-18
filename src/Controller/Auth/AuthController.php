<?php
namespace App\Controller\Auth ;

use App\class\User;
use App\model\Usermodel;
class Authcontroller{

  private $usermodel ;

  public function __construct()
  {
    $this->usermodel = new Usermodel();
  }


public function login($email, $password) {
   
    $result = $this->usermodel->findUserByEmailAndPassword($email, $password);

    if ($result['status'] === "success") {
        $user = $result['user'];
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getNom();
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_role'] = $user->getRole()->getTitle();

        if ($user->getRole()->getTitle() == "Admin") {
            header("Location:../admin/dashboard.php");
        } elseif ($user->getRole()->getTitle() == "Etudiant") {
            header("Location:../etudiant/etudiant.php");
        } elseif ($user->getRole()->getTitle() == "Enseignant") {
            header("Location:../ensignant/ensignant.php");
        }
        exit();
    } else {
        return $result['message']; 
    }
}



    public function createUser($name,$email,$password,$role){
        
        $user = $this->usermodel->createUserM($name,$email,$password,$role);
        
        if($user){
            header("Location:../../view/auth/login.php");
            exit();
        }
    }

      public function getUsers(){

        $users = $this->usermodel->getAllusers();
        return $users  ;

      }

       public function activeUserC($id){

        $userActive = $this->usermodel->activerUserM($id);
        return $userActive ;
       }

       public function deletUserC($id){

        $userdelet = $this->usermodel->deletUserM($id);
        return $userdelet ;
       }

       public function susPUserC($id){

        $userdelet = $this->usermodel->susPUserM($id);
        return $userdelet ;
       }
}
?>
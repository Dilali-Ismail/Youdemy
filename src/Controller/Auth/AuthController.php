<?php
namespace App\Controller\Auth ;

use App\class\User;
use App\model\Usermodel;
class Authcontroller{

//   private $usermodel ;

//   public function __construct()
//   {
//     $this->user = new Usermodel();
//   }


    public function login($email,$password){
        
        $usermodel = new Usermodel();
        $user = $usermodel->findUserByEmailAndPassword($email,$password);

        if($user != null){

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_name'] = $user->getNom();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_role'] = $user->getRole()->getTitle();

            if($user->getRole()->getTitle() == "Admin"){
                header("Location:../admin/dashboard.php");
            }
            else if($user->getRole()->getTitle() == "Etudiant"){
                header("Location:../etudiant/etudiant.php");
            }
            else if($user->getRole()->getTitle() == "Enseignant"){
                header("Location:../ensignant/ensignant.php");
            }
           
        }
        else
        {
            echo "email or password are incorrect";
        }

    }

    public function createUser($name,$email,$password,$role){
        $usermodel = new Usermodel();
        $user = $usermodel->createUserM($name,$email,$password,$role);
        
        if($user){
            header("Location:../../view/auth/login.php");
            exit();
        }
    }

      public function getUsers(){
        $usermodel = new Usermodel();
        $users = $usermodel->getAllusers();
        return $users  ;
      }

       public function activeUserC($id){
        $usermodel = new Usermodel();
        $userActive = $usermodel->activerUserM($id);
        return $userActive ;
       }

       public function deletUserC($id){
        $usermodel = new Usermodel();
        $userdelet = $usermodel->deletUserM($id);
        return $userdelet ;
       }
       public function susPUserC($id){
        $usermodel = new Usermodel();
        $userdelet = $usermodel->susPUserM($id);
        return $userdelet ;
       }
}
?>
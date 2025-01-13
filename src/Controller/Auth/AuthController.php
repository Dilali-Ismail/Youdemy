<?php
namespace App\Controller\Auth ;
use App\model\Usermodel;
class Authcontroller{

    public function login($email,$password){

        $usermodel = new Usermodel();
        $user = $usermodel->findUserByEmailAndPassword($email,$password);

        if($user != null){

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_name'] = $user->getNom();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_role'] = $user->getRole()->getTitle();

            if($user->getRole()->getTitle() == "admin"){
                header("Location:../admin/dashboard.php");
            }
            else if($user->getRole()->getTitle() == "candidat"){
                header("Location:../candidat/candidat.php");
            }
            else if($user->getRole()->getTitle() == "recruteur"){
                header("Location:../recruteur/recruteurpage.php");
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
}
?>
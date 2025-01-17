<?php
namespace App\config;

ob_start();


use Dotenv\Dotenv;
use PDO;
use PDOException;

class Connexion {
    private static $con;

    
    public static function connection() {
        if(self::$con != null){
        return self::$con;
    }
    else{
         $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();

        try {

            self::$con = new PDO(
                "mysql:host=".$_ENV["LOCALHOST"].";dbname=".$_ENV["DATABASE"].";port=".$_ENV["PORT"],
                $_ENV["USER"],
                $_ENV["USER_Password"]
            );
            return self::$con;  
        } catch (PDOException $e) {
            echo "Error db: " . $e->getMessage();
            error_log("Connection failed: " . $e->getMessage());
        }
    }
       
       
    }
}

ob_end_flush();

?>
<?php
namespace App\config;

ob_start();


use Dotenv\Dotenv;
use PDO;
use PDOException;

class Connexion {
    private $con;
    public function connection() {
        // Load environment variables
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();

        try {
            // Create PDO connection
            $this->con = new PDO(
                "mysql:host=".$_ENV["LOCALHOST"].";dbname=".$_ENV["DATABASE"].";port=".$_ENV["PORT"],
                $_ENV["USER"],
                $_ENV["USER_Password"]
            );
            return $this->con;  // Return connection object
        } catch (PDOException $e) {
            echo "Error db: " . $e->getMessage();
            error_log("Connection failed: " . $e->getMessage());
        }
    }
}

// End output buffering to ensure no output is sent before headers
ob_end_flush();

?>
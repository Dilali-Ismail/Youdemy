<?php
require_once './vendor/autoload.php';
use App\Controller\CoursController;

$cours = new CoursController();

if(isset($_GET['search'])){
$search =  htmlspecialchars($_GET['search']);
$data = $cours->searchtCours($search );
print_r($data );

}

?>
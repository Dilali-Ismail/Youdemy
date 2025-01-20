<?php
require_once './vendor/autoload.php';
use App\Controller\CoursController;

$cours = new CoursController();

// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;
// $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';



if(isset($_GET['search'])){
$search =  htmlspecialchars($_GET['search']);
$data = $cours->searchtCours($search );
print_r($data );

}


// header('Content-Type: application/json');
// echo json_encode($data);

?>
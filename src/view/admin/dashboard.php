<?php
require_once '../../../vendor/autoload.php';
use App\Controller\CoursController;
$cours = new CoursController();

$TotalCours = $cours->TotalCours();
$CourAvecPlusEtudiants = $cours->CourAvecPlusEtudiants();
$RepartitionParCategorie = $cours->RepartitionParCategorie();
$TopTroisEnsignants = $cours->TopTroisEnsignants();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Youdemy </title>

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../../index.php">
                
                <div class="sidebar-brand-text mx-3">Udemy
                     </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tages
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-tag"></i>
                    <span>Tags</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tags</h6>
                        <a class="collapse-item" href="tagsTable.php">Tags</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <!-- Nav Item - Utilities Collapse Menu -->

            <div class="sidebar-heading">
                Categories
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-list"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories</h6>
                        <a class="collapse-item" href="categorieTable.php">Categories</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               Users
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users action:</h6>
                        <a class="collapse-item" href="userTables.php">Users</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 mt-5">Dashboard</h1>
                    </div>
                    <div class="row ">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nombre total de cours</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?=  $TotalCours ;?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            <?=  $CourAvecPlusEtudiants['title'] ;?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?=  $CourAvecPlusEtudiants['Users'] ;?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <!-- Content Row -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="h3 mb-0 text-gray-800 mt-5">Repartition par catégorie</h4>
                    </div>

                    <div id="content-wrapper" class="container my-5 " >
                    <table class="table table-bordered text-center shadow-sm">
                    <thead class="table-primary  bg-gradient-primary text-white">
                        <tr>
                         <th>Catégorie</th>
                         <th>Nombre de Cours</th>
                       </tr>

                   </thead>
                  <tbody class="text-black">
                 <?php foreach ( $RepartitionParCategorie as $value): ?>
                    <tr>
                        <td>  <?php echo $value['name'] ?></td>
                        <td>  <?php echo $value['Courses'] ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
       </div>
       
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="h3 mb-0 text-gray-800 mt-5">Top 3 enseignants
                        ​</h4>
                    </div>

                    <div id="content-wrapper" class="container my-5 " >
                    <table class="table table-bordered text-center shadow-sm">
                    <thead class="table-primary  bg-gradient-primary text-white">
                        <tr>
                         <th>Ensignant</th>
                         <th>Nombre de Cours</th>
                       </tr>

                   </thead>
                  <tbody class="text-black">
                 <?php foreach ($TopTroisEnsignants as $value): ?>
                    <tr>
                        <td>  <?php echo $value['name'] ?></td>
                        <td>  <?php echo $value['Courses'] ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
       </div>




                   
       </div>

     
      
                  

                   

      </div>
                <!-- /.container-fluid -->

            </div>
            
        </div>
    </div>


    

    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../../public/js/demo/chart-area-demo.js"></script>
    <script src="../../../public/js/demo/chart-pie-demo.js"></script>
    <script src="https://kit.fontawesome.com/37ceac21c3.js" crossorigin="anonymous"></script>

</body>

</html>
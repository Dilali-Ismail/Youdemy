<?php
require_once '../../../vendor/autoload.php';
use App\Controller\Auth\Authcontroller ;
$User = new Authcontroller();


if(isset($_POST['IdUserActive'])){
    $id = $_POST['IdUserActive'];
    $User->activeUserC($id);

}

if(isset($_POST['IdUserdelet'])){
    $id = $_POST['IdUserdelet'];
    $User->deletUserC($id);

}

if(isset($_POST['IdUserSusp'])){
    $id = $_POST['IdUserSusp'];
    $User->susPUserC($id);

}

$resulUsers = $User->getUsers();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User</title>
    <link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../../../public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <a class="nav-link" href="./dashboard.php">
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
                        <a class="collapse-item" href="./tagsTable.php">Tags</a>
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
                        <a class="collapse-item" href="./categorieTable.php">Categories</a>
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
                        <a class="collapse-item" href="./userTables.php">Users</a>
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

              
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 mt-5">Users</h1>


                    <form id="tableusersubmit" action="" method="post">
                                 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Activation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center align-middle">
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Activation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="text-center align-middle">
                                        <?php
                                        foreach ($resulUsers as $key => $value ) :
                                        ?>
                                        <tr>
                                            <td><?=$value['id'] ?></td>
                                            <td ><?=$value['name'] ?></td>
                                            <td><?=$value['email']?></td>
                                            <td><?=$value['role_title'] ?></td>
                                            <td> 
                                                <?php if($value['isActive'] == 1) : ?>
                                                    <button class="btn btn-success ActiveBtn" > <input type="text" hidden >Active</button>
                                                <?php else: ?>
                                                    <button onclick="ActiveUserFunc(event , <?=$value['id'] ?>)" class="btn btn-danger ActiveBtn" name="ActiveUser"> <input type="text" hidden > Not Active</button>
                                                <?php endif ;?>
                                            </td>
                                            <td>  
                                            <?php if($value['isActive'] == 1) : ?>
                                             <button onclick="suspendUserFunc(event , <?=$value['id'] ?>)" type="button" class="btn btn-primary"><input type="text" hidden >Suspended</button>
                                             <?php endif ;?>
                                             <button href="#" class="btn btn-danger" onclick="deletUserFunc(event , <?=$value['id'] ?>)" name="deletetUser"><input type="text" hidden >Supprimer</button>
                                            </td>
                                        </tr>
                                        <?php endforeach ;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
             </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../../../public/js/demo/datatables-demo.js"></script>
    <script src="https://kit.fontawesome.com/37ceac21c3.js" crossorigin="anonymous"></script>

</body>

<script>
    function ActiveUserFunc(e , id){
        e.preventDefault();
        const inputhidden = event.target.querySelector('input')
        inputhidden.setAttribute("name" , 'IdUserActive');
        inputhidden.setAttribute("value" , id);
        console.log(inputhidden)
        document.getElementById('tableusersubmit').submit();
    }

    function deletUserFunc(e , id){
        e.preventDefault();
        const inputhidden = event.target.querySelector('input')
        inputhidden.setAttribute("name" , 'IdUserdelet');
        inputhidden.setAttribute("value" , id);
        console.log(inputhidden)
        document.getElementById('tableusersubmit').submit();
    }

    function suspendUserFunc(e , id){
        e.preventDefault();
        const inputhidden = event.target.querySelector('input');
        inputhidden.setAttribute("name" , 'IdUserSusp');
        inputhidden.setAttribute("value" , id);
        console.log(inputhidden)
        document.getElementById('tableusersubmit').submit();
    }
    
</script>
</html>
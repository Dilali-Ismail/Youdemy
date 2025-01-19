<?php
session_start();

require_once './vendor/autoload.php';
use App\Controller\CoursController;

$cours = new CoursController();

// Gestion de l'inscription
if(isset($_POST['Inscripter'])){
    $userID = $_SESSION['user_id'];
    $coursID = $_POST['idcours'];
    $cours->Inscripter($userID, $coursID);
}

// Gestion de la déconnexion
if (isset($_POST['deconnecter'])) {
    session_unset();  
    session_destroy(); 
    header("Location:./src/view/auth/login.php"); 
    exit();                                                   
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;  

// Récupérer les données de cours                  
$data = $cours->getCours($page, $limit);
$courses = $data['courses'];
$totalPages = $data['totalPages'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy - Learn Anytime, Anywhere</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-black">Udemy</a>
      <div class="hidden md:flex items-center justify-center space-x-6 flex-grow">
        <?php if(isset($_SESSION['user_id']) && (strcmp($_SESSION['user_role'], "Enseignant") == 0 || strcmp($_SESSION['user_role'], "Etudiant") == 0)): ?>
            <a href="../../../index.php" class="text-gray-600 hover:text-purple-600">Accueil</a>
            <?php if(strcmp($_SESSION['user_role'], "Enseignant") == 0): ?>
                <a href="./src/view/ensignant/ensignant.php" class="text-gray-600 hover:text-purple-600">Mes Cours</a>
            <?php endif; ?>
            <?php if(strcmp($_SESSION['user_role'], "Etudiant") == 0): ?>
                <a href="./src/view/etudiant/etudiant.php" class="text-gray-600 hover:text-purple-600">Mes Cours</a>
            <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="hidden md:flex items-center space-x-4">
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="./src/view/auth/login.php" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Sign In</a>
            <a href="./src/view/auth/registre.php" class="px-4 py-2 bg-gray-200 text-purple-600 rounded-md hover:bg-gray-300">Sign Up</a>
        <?php else: ?>
            <form action="" method="post">
                <button type="submit" name="deconnecter" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Déconnexion</button>
            </form>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Search Bar -->
  <section class="bg-purple-600 py-8">
    <div class="container mx-auto px-6 text-center">
      <h1 class="text-3xl font-bold text-white mb-4">Find Your Perfect Course</h1>
      <div class="flex justify-center">
        <input type="text" placeholder="Search for courses..." class="w-full max-w-lg px-4 py-2 rounded-l-md focus:outline-none"/>
        <button class="bg-white text-purple-600 px-6 py-2 rounded-r-md font-bold hover:bg-gray-200">Search</button>
      </div>
    </div>
  </section>

  <!-- Courses Section -->
  <section class="container mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Available Courses</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Loop through the courses -->
      <?php foreach ($courses as $value): ?>
      <form action="" method="post">
        <div class="bg-white shadow rounded-md overflow-hidden">
          <img src="./public/img/udemy.png" alt="Course Image" class="w-full h-48 object-cover">
          <div class="p-4">
            <input type="text" hidden name="idcours" value="<?= $value['id'] ?>">
            <h3 class="font-bold text-lg"><?= $value['title'] ?></h3>
            <p class="text-gray-600 mb-2"><?= $value['description'] ?></p>
            <p class="text-sm text-gray-500"><span class="font-bold">Instructor:</span> <?= $value['author'] ?></p>
            <p class="text-sm text-gray-500"><span class="font-bold">Category:</span> <?= $value['name'] ?></p>
            <p class="text-sm text-gray-500"><span class="font-bold">Tags:</span>
              <?php 
              $tags = explode(',', $value['tags']);
              foreach ($tags as $tag): ?>
                #<?= htmlspecialchars($tag) ?>
              <?php endforeach; ?>
            </p>
            <button type="submit" name="Inscripter" class="w-full mt-4 bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Enroll Now</button>
          </div>
        </div>
      </form>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8">
      <!-- Display page links -->
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="page-link px-4 py-2 mx-1 bg-purple-600 text-white rounded-md hover:bg-purple-700" name = "page"><?= $i ?></a>
      <?php endfor; ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-6 text-center">
      <p>© 2025 Youdemy. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>

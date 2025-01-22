<?php
session_start();
if (!isset($_SESSION['user_id']) || strcmp($_SESSION['user_role'], "Etudiant")!= 0) {
    header("Location:../auth/login.php"); 
    exit();
}
require_once '../../../vendor/autoload.php';
use App\Controller\CoursController;
$cours = new CoursController();
$resultCours = $cours->inscriptionCours($_SESSION['user_id']);

if(isset($_POST['detacher'])){
  
  $coursID = $_POST['idcours'] ;
  $cours->InscripterOff($coursID);
  header("Location:./etudiant.php");
}

if (isset($_POST['deconnecter'])) {

  session_unset();  
  session_destroy(); 
  header("Location:../auth/login.php"); 
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Cours</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white shadow">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="../../../index.php" class="text-2xl font-bold text-purple-600"><img src="../../../public/img/udemy.png" alt="logo" width="120px" height="120px"></a>
      <div class="hidden md:flex items-center justify-center space-x-6 flex-grow">
        <a href="../../../index.php" class="text-gray-600 hover:text-purple-600">Accuille</a>
        <a href="./etudiant.php" class="text-gray-600 hover:text-purple-600">Mes Cours</a>
      </div>
      <div class="hidden md:flex items-center space-x-4">
        <form action="" method="post">
          <button type="submit" name="deconnecter" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Déconnexion</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="bg-purple-600 py-12">
    <div class="container mx-auto text-center">
      <h1 class="text-4xl font-bold text-white">Gestion des Cours</h1>
      <p class="text-lg text-purple-200 mt-4">Créez, modifiez et gérez vos cours facilement.</p>
    </div>
  </header>

  <!-- Main Section -->
  <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Courses List -->
    <section>
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Bonjour Mr <?= $_SESSION['user_name']?> </h1>
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Mes Cours</h2>
      <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Example Course Card -->
        <?php foreach ($resultCours as $SinglCours  => $value): ?>
          <form action="" method="post">
        <div class="bg-white shadow rounded-lg p-4">
          <!-- Video Section -->
          <div class="mt-4">
            <iframe 
              class="w-full h-64 rounded-md border border-gray-300"
              src="<?=$value['content']?>" 
              title="Vidéo ajoutée"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
          </div>

          <!-- Title -->
          <h3 class="text-lg font-bold mt-4 mb-2"><?=$value['title']?></h3>
          <input type="text" hidden name="idcours" value="<?=$value['id'] ?>">

          <!-- Enseignant -->
          <p class="text-sm text-gray-600">Ensigant:<?= ' '.$value['Auth']?></p> 

          <!-- Categories -->
          <p class="text-sm text-gray-600">Catégorie: <?=$value['name']?></p>

          <!-- Description -->
          <p class="text-sm text-gray-600 mt-4">
          <?=$value['description']?>
          </p>

          <!-- Buttons -->
          <div class="mt-4 flex space-x-4">
            <button 
              type="submit"
              name="detacher"
              class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
              unroll
            </button>
          </div>
        </div>
        </form>
        <?php endforeach; ?>
       
      </div>
    </section>

  </main>

  <!-- JavaScript -->
  <script>
    // Modal Logic
    const createModal = document.getElementById('create-course-modal');

    document.getElementById('create-course-btn').addEventListener('click', () => {
      createModal.classList.remove('hidden');
    });

    function closeCreateModal() {
      createModal.classList.add('hidden');
    }

    // Initialize Select2
    $(document).ready(function () {
      $('.js-example-basic-multiple').select2();
    });
    
    // Edit Modal Logic
    function openEditModal(title, category, tags, description, videoUrl) {
      document.getElementById('edit-title').value = title;
      document.getElementById('edit-category').value = category;
      document.getElementById('edit-tags').value = tags;
      document.getElementById('edit-description').value = description;
      document.getElementById('edit-video').value = videoUrl;
      document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeEditModal() {
      document.getElementById('edit-modal').classList.add('hidden');
    }
  </script>

</body>
</html>

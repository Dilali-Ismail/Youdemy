<?php 

require_once '../../../vendor/autoload.php';

use App\Controller\CategorieController ;
use App\Controller\TagController ;
use App\Controller\CoursController;

$Tags = new TagController();
$resultTags = $Tags->getTags();

   
$Categories = new CategorieController();
$resultCategories = $Categories->getCategorieC();

$cours = new CoursController();

if (isset($_POST['addCours']) && !empty($_POST['tags']) ){
  $title = $_POST['title'];
  $description = $_POST['description'];
  $content = $_POST['content'];
  $categorie_id = $_POST['category'];
  $tags = $_POST['tags']; 
  
  $result = $cours->createCoursC($title, $description, $content,$categorie_id,$tags);

  if ($result) {
    header("Location:./ensignant.php");
    exit();
  } else {
      echo "<p class='text-red-500'>Failed to create cours.</p>";
  }
}













$resultCours = $cours->getCours();



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
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <a href="#" class="text-2xl font-bold text-purple-600">EduPlatform</a>
        <div class="flex items-center space-x-4">
          <a href="#" class="text-gray-600 hover:text-purple-600">Accueil</a>
          <a href="#" class="text-gray-600 hover:text-purple-600">Mon Compte</a>
          <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Déconnexion</a>
        </div>
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

    <!-- Add Course Button -->
    <div class="flex justify-end mb-6">
      <button id="create-course-btn" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
        Ajouter un nouveau cours
      </button>
    </div>

    <!-- Courses List -->
    <section>
  <h2 class="text-2xl font-semibold mb-6 text-gray-800">Mes Cours</h2>
  <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Example Course Card -->

    <?php foreach ($resultCours as $SinglCours  => $value): ?>
    

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

      <!-- Categories -->
      <p class="text-sm text-gray-600">Catégorie: <?=$value['name']?></p>

      <!-- Tags -->
      <div class="flex flex-wrap gap-2">
      <?php 
       $tagscours = explode(',', $value['tags']);
       foreach ($tagscours as $tag): ?>

      <p class="text-sm text-gray-600 border border-purple-500 px-2 py-1 rounded"><?= htmlspecialchars($tag) ?></p>

      <?php endforeach; ?>
      </div>
      <!-- Description -->
      <p class="text-sm text-gray-600 mt-4">
      <?=$value['description']?>
      </p>

      <!-- Buttons -->
      <div class="mt-4 flex space-x-4">
        <button 
          class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700"
          onclick="openEditModal('Introduction à JavaScript', 'Développement Web', ['Programmation', 'Frontend'], 'Ce cours fournit une introduction complète à JavaScript, couvrant les bases et les concepts avancés.', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
          Modifier
        </button>
        <button class="text-red-600 hover:underline">Supprimer</button>
      </div>
    </div>

    <?php endforeach; ?>




  </div>
</section>


<!-- Edit Modal -->
<div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
    <h2 class="text-xl font-bold mb-4">Modifier le Cours</h2>
    <form id="edit-form">
      <!-- Video URL -->
      <div class="mb-4">
        <label for="edit-video" class="block text-sm font-medium text-gray-700">Vidéo URL</label>
        <input type="url" id="edit-video" name="edit-video" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Title -->
      <div class="mb-4">
        <label for="edit-title" class="block text-sm font-medium text-gray-700">Titre</label>
        <input type="text" id="edit-title" name="edit-title" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Category -->
      <div class="mb-4">
        <label for="edit-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
        <input type="text" id="edit-category" name="edit-category" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Tags -->
      <div class="mb-4">
        <label for="edit-tags" class="block text-sm font-medium text-gray-700">Tags</label>
        <input type="text" id="edit-tags" name="edit-tags" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="edit-description" name="edit-description" rows="4"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"></textarea>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end space-x-4">
        <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
          Annuler
        </button>
        <button type="submit" name ="" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
          Enregistrer
        </button>
      </div>
    </form>
  </div>
</div>


    <!-- Statistics Section -->
    <section class="mt-12">
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Statistiques</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-lg font-bold">Nombre de cours</h3>
          <p class="text-4xl font-semibold text-purple-600">5</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-lg font-bold">Étudiants inscrits</h3>
          <p class="text-4xl font-semibold text-purple-600">120</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-lg font-bold">Cours en attente</h3>
          <p class="text-4xl font-semibold text-purple-600">2</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-purple-600 text-white py-8">
    <div class="container mx-auto text-center">
      <p class="text-sm">&copy; 2025 EduPlatform. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- div formular -->
  <div id="create-course-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Ajouter un nouveau cours</h2>
      <form id="add-course-form" class="space-y-6" method="post">
        <!-- Title -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
          <input type="text" id="title" name="title" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
        </div>
        <!-- Category -->
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
          <select id="category" name="category" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
            <?php foreach ($resultCategories  as $categorie => $value ) :?>
                <option value="<?=$value['id'] ?>"><?=$value['name'] ?></option>
             <?php endforeach ;?>
          </select>
        </div>
        <!-- Tags -->
   
            <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <select class="js-example-basic-multiple js-example-responsive " style="width: 75%" name="tags[]" multiple="multiple">
            <?php foreach ($resultTags  as $tag => $value ) :?>
                <option value="<?=$value['id'] ?>"><?=$value['title']?></option>
             <?php endforeach ;?>
            </select>
            </div>

        <!-- Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="description" name="description" rows="4" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"></textarea>
        </div>
        <!-- Content -->
        <div>
           <label for="content" class="block text-sm font-medium text-gray-700">URL de la vidéo</label>
           <input type="url" id="content" name="content" placeholder="https://example.com/video"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                required>
        </div>
        <!-- Submit Buttons -->
        <div class="flex justify-end">
          <button type="button" onclick="closeCreateModal()"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
            Annuler
          </button>
          <button type="submit"
                  name ="addCours"
            class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 ml-2">
            Enregistrer
          </button>
        </div>
      </form>
    </div>
  </div>

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
  </script>
  <script>
  // Function to open the edit modal
  function openEditModal(title, category, tags, description, videoUrl) {
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-category').value = category;
    document.getElementById('edit-tags').value = tags.join(', ');
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-video').value = videoUrl;
    document.getElementById('edit-modal').classList.remove('hidden');
  }

  // Function to close the edit modal
  function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
  }
</script>



</body>
</html>

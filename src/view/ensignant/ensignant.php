<?php 
session_start();
if (!isset($_SESSION['user_id']) || strcmp($_SESSION['user_role'], "Enseignant")!= 0) {
    header("Location:../../../auth/login.php"); 
    exit();
}
require_once '../../../vendor/autoload.php';

use App\Controller\CategorieController ;
use App\Controller\TagController ;
use App\Controller\CoursController;

$Tags = new TagController();
$resultTags = $Tags->getTags();

   
$Categories = new CategorieController();
$resultCategories = $Categories->getCategorieC();

$cours = new CoursController();

if (isset($_POST['deconnecter'])) {

  session_unset();  
  session_destroy(); 
  header("Location:../auth/login.php"); 
  exit();

}


if (isset($_POST['addCours']) && !empty($_POST['tags']) ){
  $title = $_POST['title'];
  $description = $_POST['description'];
  $content = $_POST['content'];
  $categorie_id = $_POST['category'];
  $tags = $_POST['tags']; 
  
  $result = $cours->createCoursC($title, $description, $content,$categorie_id,$tags,$_SESSION['user_id']);

  if ($result) {
    header("Location:./ensignant.php");
    exit();
  } else {
      echo "<p class='text-red-500'>Failed to create cours.</p>";
  }
}
if (isset($_POST['editCours'])  && !empty($_POST['ediTtags']) ){
  $id =  $_POST['edit-id'];
  $titleEdit = $_POST['edit-title'];
  $descriptionEdit = $_POST['edit-description'];
  $contentEdit = $_POST['edit-video'];
  $categorie_idEdit = $_POST['edit-category'];
  $newTags = $_POST['ediTtags']; 
  
  
  
 
  $result = $cours->editCoursC( $id,$titleEdit ,$descriptionEdit,$contentEdit,$categorie_idEdit,$newTags);

  if ($result) {
    header("Location:./ensignant.php");
    exit();
  } else {
      echo "<p class='text-red-500'>Failed to edit cours.</p>";
  }
  
}

if(isset($_POST['deletCours'])){

  $id =  $_POST['idcours'];
  $delet =  $cours->deletCoursC($id);
  
}

$NbrCours['NbrCours']=  0;

if($cours->NbrCours($_SESSION['user_id'])){
  $NbrCours = $cours->NbrCours($_SESSION['user_id']) ;
}

$NbrCours['NbrCours'];
$resultCours = $cours->getCoursByAuthor($_SESSION['user_id']);
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
      <a href="../../../index.php" class="text-2xl font-bold text-purple-600">Youdemy</a>
      <div class="hidden md:flex items-center justify-center space-x-6 flex-grow">
        <a href="../../../index.php" class="text-gray-600 hover:text-purple-600">Accuille</a>
        <a href="./ensignant.php" class="text-gray-600 hover:text-purple-600">Mes Cours</a>
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

    <!-- Add Course Button -->
    <div class="flex justify-end mb-6">
      <button id="create-course-btn" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
        Ajouter un nouveau cours
      </button>
    </div>

    <!-- Courses List -->
    <section>
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Bonjour Mr <?= $_SESSION['user_name']?> </h2>
  <h2 class="text-2xl font-semibold mb-6 text-gray-800">Mes Cours</h2>
  <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Example Course Card -->
 <!-- Card______________________________________________________________________ -->
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
          type="button"
          class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700"
          onclick="openEditModal( <?=$value['id'] ?> ,'<?=$value['title']?>', <?=$value['CategiId']?> , '<?=$value['Tags_id']?>' , '<?=$value['description']?>', '<?=$value['content']?>')">
          Modifier
        </button>
        <button class="text-red-600 hover:underline" name = "deletCours">Supprimer</button>
      </div>
    </div>
     </form>

    <?php endforeach; ?>

    <!-- Card______________________________________________________________________ -->
    
  </div>
</section>


<!-- Edit Modal----------------------------------------------------------------------------- -->
<div id="edit-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center ">
  <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
    <h2 class="text-xl font-bold mb-4">Modifier le Cours</h2>
    <form id="edit-form" method="post">
      <!-- Video URL -->
      <div class="mb-4">
        <label for="edit-video" class="block text-sm font-medium text-gray-700">Vidéo URL</label>
        <input type="url" id="edit-video" name="edit-video" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Title -->
      <div class="mb-4">
        <label for="edit-title" class="block text-sm font-medium text-gray-700">Titre</label>
        <input type="text" hidden id="edit-id" name="edit-id">
        <input type="text" id="edit-title" name="edit-title" 
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
      </div>

      <!-- Category -->
      <div class="mb-4">
        <label for="edit-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
           <select name="edit-category" id="edit-category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
              <?php foreach ($resultCategories  as $categorie => $value ) :?>
                <option value="<?=$value['id'] ?>"><?=$value['name'] ?></option>
             <?php endforeach ;?>
           </select>
        
      </div>

      <!-- Tags -->
                
      <div class="mb-4">
        <label for="edit-tags" class="block text-sm font-medium text-gray-700">Tags</label>
        <select id="edit-tags" name="ediTtags[]" class="js-example-basic-multiple js-example-responsive " style="width: 75%" name="tags[]" multiple="multiple">
            <?php foreach ($resultTags  as $tag => $value ) :?>
                <option value="<?=$value['id'] ?>"><?=$value['title']?></option>
             <?php endforeach ;?> 
        </select>
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
        <button type="submit" name ="editCours" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
          Enregistrer
        </button>
      </div>
    </form>
  </div>
</div>

<!-- --------------------------------------------------------------------------------------- -->

    <!-- Statistics Section -->
    <section class="mt-12">
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Statistiques</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-lg font-bold">Nombre de cours</h3>
          <p class="text-4xl font-semibold text-purple-600"> <?php echo  $NbrCours['NbrCours'] ?> </p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="text-lg font-bold">Étudiants inscrits</h3>
          <p class="text-4xl font-semibold text-purple-600">120</p>
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
   <!-- div formular______________________________________________________________________ -->
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
<!-- div formular______________________________________________________________________ -->
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
  function openEditModal(id,title, category, tags, description, videoUrl) {
    document.getElementById('edit-id').value = id;  
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-category').value = category;
    // document.getElementById('edit-tags').value = tags;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-video').value = videoUrl;
    document.getElementById('edit-modal').classList.remove('hidden');

    var selectElement = document.getElementById('edit-tags');
    // Initialize the Select2 plugin
    $(selectElement).select2();
    console.log({tags: tags})
    var valuesArray = tags.split(',');
    // Set the default selected options (e.g., values 2 and 3)
    selectElement.value = "2"; // This will select option 2
    $(selectElement).val(valuesArray).trigger('change'); // Select options 2 and 3 by default

  }

  // Function to close the edit modal
  function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
  }
</script>



</body>
</html>

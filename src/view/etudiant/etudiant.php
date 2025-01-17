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

    <!-- Courses List -->
    <section>
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Mes Cours</h2>
      <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Example Course Card -->
        <div class="bg-white shadow rounded-lg p-4">
          <!-- Video Section -->
          <div class="mt-4">
            <iframe 
              class="w-full h-64 rounded-md border border-gray-300"
              src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
              title="Vidéo ajoutée"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
          </div>

          <!-- Title -->
          <h3 class="text-lg font-bold mt-4 mb-2">Introduction à PHP</h3>

          <!-- Enseignant -->
          <p class="text-sm text-gray-600">Enseignant: John Doe</p> <!-- Nom de l'enseignant -->

          <!-- Categories -->
          <p class="text-sm text-gray-600">Catégorie: Développement Web</p>

          <!-- Tags -->
          <div class="flex flex-wrap gap-2">
            <p class="text-sm text-gray-600 border border-purple-500 px-2 py-1 rounded">PHP</p>
            <p class="text-sm text-gray-600 border border-purple-500 px-2 py-1 rounded">Backend</p>
          </div>

          <!-- Description -->
          <p class="text-sm text-gray-600 mt-4">
            Ce cours vous introduit aux concepts fondamentaux de PHP pour le développement backend.
          </p>

          <!-- Buttons -->
          <div class="mt-4 flex space-x-4">
            <button 
              type="button"
              class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700"
              onclick="openEditModal('Introduction à PHP', 'Développement Web', ['PHP', 'Backend'], 'Ce cours vous introduit aux concepts fondamentaux de PHP pour le développement backend.', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
              Modifier
            </button>
            <button class="text-red-600 hover:underline" name="deletCours">Supprimer</button>
          </div>
        </div>

        <!-- Another Example Course Card -->
        <div class="bg-white shadow rounded-lg p-4">
          <div class="mt-4">
            <iframe 
              class="w-full h-64 rounded-md border border-gray-300"
              src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
              title="Vidéo ajoutée"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
          </div>

          <h3 class="text-lg font-bold mt-4 mb-2">Apprendre JavaScript</h3>

          <!-- Enseignant -->
          <p class="text-sm text-gray-600">Enseignant: Jane Smith</p> <!-- Nom de l'enseignant -->

          <p class="text-sm text-gray-600">Catégorie: Développement Frontend</p>

          <div class="flex flex-wrap gap-2">
            <p class="text-sm text-gray-600 border border-purple-500 px-2 py-1 rounded">JavaScript</p>
            <p class="text-sm text-gray-600 border border-purple-500 px-2 py-1 rounded">Frontend</p>
          </div>

          <p class="text-sm text-gray-600 mt-4">
            Ce cours vous enseigne les bases du JavaScript pour créer des applications frontend dynamiques.
          </p>

          <div class="mt-4 flex space-x-4">
            <button 
              type="button"
              class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700"
              onclick="openEditModal('Apprendre JavaScript', 'Développement Frontend', ['JavaScript', 'Frontend'], 'Ce cours vous enseigne les bases du JavaScript pour créer des applications frontend dynamiques.', 'https://www.youtube.com/embed/dQw4w9WgXcQ')">
              Modifier
            </button>
            <button class="text-red-600 hover:underline" name="deletCours">Supprimer</button>
          </div>
        </div>
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

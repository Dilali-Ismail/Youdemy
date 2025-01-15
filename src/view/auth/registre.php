<?php
require_once '../../../vendor/autoload.php';
use App\Controller\Auth\Authcontroller;
if(isset($_POST['inscription']))
{
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']))
{
  $name = $_POST['name'];
  $email = $_POST['email'] ;
  $password = $_POST['password'];
  $role = $_POST['role'];
  $Auth = new Authcontroller();
  $login = $Auth->createUser($name,$email,$password,$role);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - CareerLink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
  <!-- Navigation -->
  <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center">
       <a href="../../../index.php"><h1 class="text-2xl font-bold text-purple-500">Youdemy</h1></a> 
      </div>
    </div>
  </nav>

  <!-- Register Container -->
  <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow">
      <!-- Header -->
      <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900">Inscription</h2>
        <p class="mt-2 text-gray-600">Créez votre compte</p>
      </div>

      <!-- User Type Toggle -->
      <div class="flex rounded-lg overflow-hidden border">
        <button
          id="candidate-btn"
          class="flex-1 py-2 bg-purple-500 text-white"
          onclick="setUserType('candidate')"
        >
          Etudiant
        </button>
        <button
          id="recruiter-btn"
          class="flex-1 py-2 bg-white text-gray-600"
          onclick="setUserType('recruiter')"
        >
         Enseignant
        </button>
      </div>

      <!-- Form -->
      <form class="mt-8 space-y-6" action="" method="post">
        <!-- Dynamic Fields -->
        <div id="dynamic-fields">
          <!-- Default to Candidate -->
          <label id="name-label" class="block text-sm font-medium text-gray-700">
            Nom complet
          </label>
          <div class="mt-1 relative">
            <input
              id="name-input"
              type="text"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              name ="name"
              placeholder="Votre nom complet"
            />
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <div class="mt-1 relative">
            <input
              type="email"
              name = "email"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="vous@example.com"
            />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
          <div class="mt-1 relative">
            <input
              type="password"
              name = "password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="••••••••"
            />
          </div>
        </div>
        <input type="hidden" id="role" name="role" value="1">

        <!-- Submit Button -->
        <div>
          <button
            type="submit"
            name= "inscription"
            class="w-full py-3 px-4 text-white bg-purple-500 hover:bg-purple-700 rounded-lg"
          >
            S'inscrire
          </button>
        </div>
      </form>

      <!-- Link to Login -->
      <div class="text-center">
        <a href="login.php" class="text-sm text-purple-600 hover:text-purple-500">
          Déjà un compte ? Connectez-vous
        </a>
      </div>
    </div>
  </div>

  <script>
    function setUserType(type) {
      const dynamicFields = document.getElementById('dynamic-fields');
      const candidateBtn = document.getElementById('candidate-btn');
      const recruiterBtn = document.getElementById('recruiter-btn');
      const role = document.getElementById('role');

      if (type === 'candidate') {  
        candidateBtn.classList.remove('bg-white', 'text-gray-600');
        candidateBtn.classList.add('bg-purple-600', 'text-white');
        recruiterBtn.classList.remove('bg-purple-600', 'text-white');
        recruiterBtn.classList.add('bg-white', 'text-gray-600');
        role.value = 1;

        dynamicFields.innerHTML = `
          <label id="name-label" class="block text-sm font-medium text-gray-700">
            Nom complet
          </label>
          <div class="mt-1 relative">
            <input
              id="name-input"
              name = "name"
              type="text"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="Votre nom complet"
            />
          </div>
        `;
      } else {
        recruiterBtn.classList.remove('bg-white', 'text-gray-600');
        recruiterBtn.classList.add('bg-purple-600', 'text-white');
        candidateBtn.classList.remove('bg-purple-600', 'text-white');
        candidateBtn.classList.add('bg-white', 'text-gray-600');
        role.value = 2;

        dynamicFields.innerHTML = `
          <label id="company-label" class="block text-sm font-medium text-gray-700">
            Nom complet
          </label>
          <div class="mt-1 relative">
            <input
              id="company-input"
              name = "name"
              type="text"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="Votre nom complet"
            />
          </div>
        `;
      }
    }
  </script>
</body>
</html>

<?php
session_start();
require_once '../../../vendor/autoload.php';

use App\Controller\Auth\Authcontroller;

$message = ""; 

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = "Email ou mot de passe vide.";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Auth = new Authcontroller();
        $message = $Auth->login($email, $password);  
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
  <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center">
        <a href="../../../index.php">
        <img src="../../../public/img/udemy.png" alt="logo" width="120px" height="120px">
        </a>
      </div>
    </div>
  </nav>

  <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900">Connexion</h2>
        <p class="mt-2 text-gray-600">Accédez à votre compte</p>
      </div>

      <!-- Afficher le message d'erreur s'il existe -->
      <?php if (!empty($message)) : ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
          <?= htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>

      <form class="mt-8 space-y-6" action="" method="POST">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <div class="mt-1 relative">
            <input
              type="email"
              name="email"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="vous@example.com"
            />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
          <div class="mt-1 relative">
            <input
              type="password"
              name="password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              placeholder="••••••••"
            />
          </div>
        </div>

        <div>
          <button
            type="submit"
            name="submit"
            class="w-full py-3 px-4 text-white bg-purple-600 hover:bg-purple-700 rounded-lg"
          >
            Se connecter
          </button>
        </div>
      </form>

      <div class="text-center">
        <a href="./registre.php" class="text-sm text-purple-600 hover:text-purple-500">
          Pas encore de compte ? Inscrivez-vous
        </a>
      </div>
    </div>
  </div>
</body>
</html>

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
      <a href="#" class="text-2xl font-bold text-blue-600">Youdemy</a>
      <div class="hidden md:flex items-center justify-center space-x-6 flex-grow">
        <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Courses</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
      </div>
      <div class="hidden md:flex items-center space-x-4">
        <a href="./src/view/auth/login.php" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Sign In</a>
        <a href="./src/view/auth/registre.php" class="px-4 py-2 bg-gray-200 text-blue-600 rounded-md hover:bg-gray-300">Sign Up</a>
      </div>
      <button class="md:hidden text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-blue-600 text-white">
    <div class="container mx-auto px-6 py-16 text-center">
      <h1 class="text-4xl font-bold mb-4">Learn Anytime, Anywhere</h1>
      <p class="text-lg mb-6">Access thousands of courses taught by industry experts.</p>
      <a href="#" class="px-6 py-3 bg-white text-blue-600 font-bold rounded-md hover:bg-gray-200">Explore Courses</a>
    </div>
  </section>

  <!-- Featured Courses -->
  <section class="container mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Popular Courses</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="bg-white shadow rounded-md overflow-hidden">
        <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-lg">Learn Python Programming</h3>
          <p class="text-gray-600">Master Python from scratch with hands-on projects.</p>
          <a href="#" class="text-blue-600 hover:underline">View Course</a>
        </div>
      </div>
      <div class="bg-white shadow rounded-md overflow-hidden">
        <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-lg">Graphic Design Essentials</h3>
          <p class="text-gray-600">Learn the principles of modern design and tools.</p>
          <a href="#" class="text-blue-600 hover:underline">View Course</a>
        </div>
      </div>
      <div class="bg-white shadow rounded-md overflow-hidden">
        <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-lg">Digital Marketing Mastery</h3>
          <p class="text-gray-600">Boost your marketing skills with real-world strategies.</p>
          <a href="#" class="text-blue-600 hover:underline">View Course</a>
        </div>
      </div>
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

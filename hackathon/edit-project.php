<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.html'); // Redirect to login page if not logged in
  exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $project_id = intval($_POST['project_id']);
}

$sql = "SELECT project_id, title_en, title_ar, supervisor, description, progress, adoption_authority, documintation, members.members_id ,
        members.name_1, members.name_2, members.name_3, members.name_4, 
        images.image_1, images.image_2, images.image_3, images.image_4, 
        users.first_name, users.last_name, category.name 
        FROM projects
        JOIN members ON projects.members_id = members.members_id
        JOIN images ON projects.images_id = images.images_id
        JOIN users ON projects.user_id = users.user_id
        JOIN category ON projects.cat_id = category.category_id
        WHERE project_id = $project_id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>University of Kerbala</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .background-logo {
      background-image: url('Images/Uni-Logo.jpg');
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
    }
  </style>
</head>

<body class="bg-white">
  <!-- Header -->
  <header class="bg-gray-800 text-white">
    <div class="container mx-auto flex justify-between items-center py-2 px-4">
      <div class="flex items-center space-x-4">
        <a href="index.php">
            <i class="fas fa-home text-xl"></i>
        </a>
      </div>
      <div class="flex items-center space-x-4">
        <i class="fas fa-envelope text-xl"></i>
        <i class="fas fa-search text-xl"></i>
        <a href="login.html">
            <i class="fas fa-user text-xl"></i>
        </a>
      </div>
    </div>
  </header>

  <!-- Logo and Title -->
  <div class="container mx-auto text-center">
    <div class="relative background-logo h-48"></div>
  </div>

  <!-- Navigation -->
  <nav class="bg-gray-900 text-white">
    <div class="container mx-auto">
      <ul class="flex justify-center space-x-4 py-2">
        <li><a class="hover:text-red-500" href="#">HOME</a></li>
        <li><a class="hover:text-red-500" href="#">ABOUT</a></li>
        <li><a class="hover:text-red-500" href="#">ADMINISTRATION</a></li>
        <li><a class="hover:text-red-500" href="#">FACULTIES</a></li>
        <li><a class="hover:text-red-500" href="#">SCIENTIFIC JOURNALS</a></li>
        <li><a class="hover:text-red-500" href="#">E-LEARNING</a></li>
        <li><a class="hover:text-red-500" href="#">REPOSITORY</a></li>
        <li><a class="hover:text-red-500" href="#">STAFF</a></li>
        <li><a class="hover:text-red-500 bg-red-700 px-2 py-1" href="#">Projects</a></li>
        <li><a class="hover:text-red-500" href="#">SCHOLARSHIPS</a></li>
        <li><a class="hover:text-red-500" href="#">HEALTH SERVICES</a></li>
        <li><a class="hover:text-red-500" href="#">VR TOUR</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main -->
  <main class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Project Information Form</h2>

    <!-- Success/Error Message -->
    <div id="formMessage" class="hidden mb-4 text-center"></div>

    <!-- Project Form -->
    <form id="projectForm" class="space-y-4"  action="update-project.php" method="POST">
      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="title_arabic" class="block text-sm font-semibold">Title (Arabic):</label>
          <input value="<?= $row['title_ar'] ?>" type="text" id="title_ar" name="title_ar" class="border px-4 py-2 w-full" required />
        </div>

        <div class="w-1/2">
          <label for="title_en" class="block text-sm font-semibold">Title (English):</label>
          <input value="<?= $row['title_en'] ?>" type="text" id="title_en" name="title_en" class="border px-4 py-2 w-full" required />
        </div>
      </div>

      <div>
        <label for="category" class="block text-sm font-semibold">Category:</label>
        <select id="category" name="category" class="border px-4 py-2 w-full" required>
          <option value="">Select Category</option>
          <option value="Research" <?= $row['name'] == 'Research' ? 'selected' : '' ?>>Research</option>
          <option value="Development" <?= $row['name'] == 'Development' ? 'selected' : '' ?>>Development</option>
          <option value="Innovation" <?= $row['name'] == 'Innovation' ? 'selected' : '' ?>>Innovation</option>
        </select>
      </div>

      <div>
        <label for="supervisor" class="block text-sm font-semibold">Supervisor Name:</label>
        <input value="<?= $row['supervisor'] ?>" type="text" id="supervisor" name="supervisor" class="border px-4 py-2 w-full" required />
      </div>

      <div>
        <label for="leader" class="block text-sm font-semibold">Leader Name:</label>
        <input value="<?= $row['first_name'] . ' ' . $row['last_name'] ?>" type="text" id="leader" name="leader" class="border px-4 py-2 w-full" required />
      </div>

      <div hidden>
        <label for="members_1" class="block text-sm font-semibold">Member 1:</label>
        <input value="<?= $row['members_id'] ?>" type="text" id="name_1" name="members_id" class="border px-4 py-2 w-full" />
      </div>

      <div>
        <label for="members_1" class="block text-sm font-semibold">Member 1:</label>
        <input value="<?= $row['name_1'] ?>" type="text" id="name_1" name="name_1" class="border px-4 py-2 w-full" />
      </div>

      <div>
        <label for="members_2" class="block text-sm font-semibold">Member 2:</label>
        <input value="<?= $row['name_2'] ?>" type="text" id="name_2" name="name_2" class="border px-4 py-2 w-full" />
      </div>

      <div>
        <label for="members_3" class="block text-sm font-semibold">Member 3:</label>
        <input value="<?= $row['name_3'] ?>" type="text" id="name_3" name="name_3" class="border px-4 py-2 w-full" />
      </div>

      <div>
        <label for="members_4" class="block text-sm font-semibold">Member 4:</label>
        <input value="<?= $row['name_4'] ?>" type="text" id="name_4" name="name_4" class="border px-4 py-2 w-full" />
      </div>

      <div>
        <label for="description" class="block text-sm font-semibold">Description (max 100 words):</label>
        <textarea id="description" name="description" class="border px-4 py-2 w-full" rows="4" maxlength="500" required><?= $row['description'] ?></textarea>
      </div>

      <div>
        <label for="progress" class="block text-sm font-semibold">Progress (%):</label>
        <input value="<?= $row['progress'] ?>" type="number" id="progress" name="progress" class="border px-4 py-2 w-full" min="0" max="100" required />
      </div>

      <!-- Adopting Authority Field -->
      <div>
        <label for="adoptingAuthority" class="block text-sm font-semibold">Adopting Authority:</label>
        <input value="<?= $row['adoption_authority'] ?>" type="text" id="adoptingAuthority" name="adoptingAuthority" class="border px-4 py-2 w-full" required />
      </div>

      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="image1" class="block text-sm font-semibold">Image 1:</label>
          <input value="<?= $row['image_1'] ?>" type="file" id="image1" name="image1" class="border px-4 py-2 w-full" />
        </div>

        <div class="w-1/2">
          <label for="image2" class="block text-sm font-semibold">Image 2:</label>
          <input value="<?= $row['image_2'] ?>" type="file" id="image2" name="image2" class="border px-4 py-2 w-full" />
        </div>
      </div>

      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="image3" class="block text-sm font-semibold">Image 3:</label>
          <input value="<?= $row['image_3'] ?>" type="file" id="image3" name="image3" class="border px-4 py-2 w-full" />
        </div>

        <div class="w-1/2">
          <label for="image4" class="block text-sm font-semibold">Image 4:</label>
          <input value="<?= $row['image_4'] ?>" type="file" id="image4" name="image4" class="border px-4 py-2 w-full" />
        </div>
      </div>

      <!-- Hidden Field -->
      <input type="hidden" value="<?= $row['project_id']?>" name="project_id"/>

      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
        Submit
      </button>
    </form>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-4">
    <div class="container mx-auto text-center">
      <p>&copy; 2023 University of Kerbala</p>
    </div>
  </footer>
</body>
</html>

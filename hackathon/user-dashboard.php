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

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID
$sql = "SELECT project_id, title_en, title_ar, supervisor, description, progress, adoption_authority, documintation, 
        members.name_1, members.name_2, members.name_3, members.name_4, 
        images.image_1, images.image_2, images.image_3, images.image_4, 
        users.first_name, users.last_name, category.name 
        FROM projects
        JOIN members ON projects.members_id = members.members_id
        JOIN images ON projects.images_id = images.images_id
        JOIN users ON projects.user_id = users.user_id
        JOIN category ON projects.cat_id = category.category_id
        WHERE projects.user_id = ?"; // Filter projects by user_id

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
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
        <a href="logout.php">
          <i class="text-xl">logout</i>
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

  <!-- User Dashboard -->
  <main class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Your Projects</h2>

    <!-- Projects List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $project_id = $row['project_id'];
          $title_en = $row['title_en'];
          $title_ar = $row['title_ar'];
          $supervisor = $row['supervisor'];
          $Description = $row['description'];
          $Progress = $row['progress'];
          $Adoption_Authority = $row['adoption_authority'];
          $Documentation = $row['documintation'];
          $members_1 = $row['name_1'];
          $members_2 = $row['name_2'];
          $members_3 = $row['name_3'];
          $members_4 = $row['name_4'];
          $images_1 = $row['image_1'];
          $images_2 = $row['image_2'];
          $images_3 = $row['image_3'];
          $images_4 = $row['image_4'];
          $Leader_f = $row['first_name'];
          $Leader_l = $row['last_name'];
          $category = $row['name'];
      ?>
          <!-- Example Project Card -->
          <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">
            <!-- Left Section: Images and Project Details -->
            <div class="flex flex-wrap gap-4 mb-4">
              <img src="<?php echo $images_1 ?>" alt="Project Image 1" class="w-32 h-32 object-cover rounded">
              <img src="<?php echo $images_2 ?>" alt="Project Image 2" class="w-32 h-32 object-cover rounded">
              <img src="<?php echo $images_3 ?>" alt="Project Image 3" class="w-32 h-32 object-cover rounded">
              <img src="<?php echo $images_4 ?>" alt="Project Image 4" class="w-32 h-32 object-cover rounded">
            </div>

            <!-- Project Information -->
            <div class="flex-1">
              <h3 class="text-lg font-semibold mb-2"><?php echo $title_en; ?></h3>
              <p class="text-sm text-gray-500 mb-2"><?php echo $title_ar; ?></p>
              <p class="text-sm mb-2">Catagory: <?php echo  $category ?></p>
              <p class="text-sm mb-2">Supervisor: <?php echo $supervisor; ?></p>
              <p class="text-sm mb-2">Leader: <?php echo $Leader_f, " ", $Leader_l ?></p>
              <p class="text-sm mb-2">Members: <?php echo $members_1 ?>, <?php echo $members_2 ?>, <?php echo $members_3 ?>, <?php echo $members_4 ?></p>
              <p class="text-sm mb-2">Progress: <?php echo $Progress ?>%</p>
              <p class="text-sm mb-2">Discription: <?php echo $Description; ?></p>
              <p class="text-sm mb-2">Adoption Authority: <?php echo $Adoption_Authority ?></p>
              <p class="text-sm mb-2">View Documentation: <?php echo $Documentation ?></p>
            </div>


            <div class="mt-auto flex justify-between space-x-4">
              <form action='edit-project.php' method='POST'>
                <input type='hidden' name='project_id' value='<?= $project_id ?>'>
                <button class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition w-full text-center">Edit</button>
              </form>
            </div>
          </div>

      <?php
        }
      } else {
        echo "No projects found.";
      }
      $conn->close();
      ?>

      <!-- Add Project -->
      <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col items-center justify-center">
        <a href="add-project.html" class="flex flex-col items-center space-y-2">
          <!-- "+" Icon -->
          <div class="text-gray-600 text-7xl">
            <i class="fas fa-plus"></i>
          </div>
          <!-- "Add Project" Text -->
          <p class="text-gray-600">Add Project</p>
        </a>
      </div>
    </div>
  </main>

</body>

</html>
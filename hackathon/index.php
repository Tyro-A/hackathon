<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>University of Kerbala</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <!-- Add Tailwind & FontAwesome scripts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <style>
    .background-logo {
      background-image: url('Images/Uni-Logo.jpg');
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
    }
    .project-image {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .project-image:hover {
    transform: scale(1.1); /* Scale up the image slightly */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Optional: Add shadow for emphasis */
  }
  </style>
</head>

<body class="bg-white">
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

        <!-- User Icon with Dropdown -->
        <div class="relative">
          <?php if (isset($_SESSION['user_id'])): ?>
            <button id="user-icon" class="flex items-center">
              <i class="fas fa-user text-xl"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded shadow-lg hidden z-10 transition-all duration-200 ease-in-out">
              <a href="dashboard-check.php" class="block px-4 py-2 hover:bg-gray-600 focus:bg-gray-600 transition-colors duration-200 ease-in-out">Dashboard</a>
              <a href="logout.php" class="block px-4 py-2 hover:bg-gray-600 focus:bg-gray-600 transition-colors duration-200 ease-in-out">Logout</a>
            </div>
          <?php else: ?>
            <!-- Redirect to login page if not logged in -->
            <a href="login.php">
              <button id="login-icon" class="flex items-center">
                <i class="fas fa-user text-xl"></i>
              </button>
            </a>
          <?php endif; ?>
        </div>
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
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Projects Archive</h2>
    <div class="flex items-center space-x-2 mb-4">
      <button class="bg-gray-200 px-4 py-2">Column visibility</button>
      <button class="bg-gray-200 px-4 py-2">Copy</button>
      <button class="bg-gray-200 px-4 py-2">CSV</button>
      <button class="bg-gray-200 px-4 py-2">Excel</button>
      <button class="bg-gray-200 px-4 py-2">PDF</button>
      <button class="bg-gray-200 px-4 py-2">Print</button>
    </div>
    <div class="flex items-center mb-4">
      <label class="mr-2" for="entries">Show</label>
      <select class="border border-gray-300 px-2 py-1" id="entries">
        <option value="25">10</option>
        <option value="50">25</option>
        <option value="100">50</option>
      </select>
      <span class="ml-2">Projects</span>
    </div>

    <!-- Projects List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
      <?php
      // الاتصال بقاعدة البيانات
      require 'connection.php';

      // استعلام لاسترداد البيانات
      $sql = "SELECT project_id, title_en,title_ar,supervisor,description,progress,adoption_authority,documintation,members.name_1,members.name_2,members.name_3,
members.name_4,images.image_1,images.image_2,images.image_3,images.image_4,users.first_name,users.last_name,category.name, approval FROM projects
JOIN members on(projects.members_id=members.members_id)
JOIN images on (projects.images_id=images.images_id)
JOIN users on (projects.user_id=users.user_id)
JOIN category on (projects.cat_id=category.category_id)";

      $result = $conn->query($sql);


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
          $approval = $row['approval'];
      ?>
          <?php if ($approval) : ?>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">

              <div class="flex flex-wrap gap-4 mb-4">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                  <?php
                  // Construct the variable name dynamically, e.g., image_1, image_2, etc.
                  $imageVar = 'images_' . $i;

                  // Check if the variable is set and not empty
                  if (!empty($$imageVar)) : ?>
                    <a href="project.php?project_id=<?php echo $project_id; ?>">
                      <img src="<?php echo $$imageVar; ?>" class="project-image w-32 h-32 object-cover rounded" alt="Project Image <?php echo $i; ?>" class="w-32 h-32 object-cover rounded">
                    </a>
                  <?php endif; ?>
                <?php endfor; ?>

              </div>

              <!-- Project Information -->
              <div class="flex-1">
                <a href="project.php?project_id=<?php echo $project_id; ?>"><h3 class="text-lg font-semibold mb-2"><?php echo $title_en; ?></h3></a>
                <p class="text-sm text-gray-500 mb-2"><?php echo $title_ar; ?></p>
                <p class="text-sm mb-2">Catagory: <?php echo  $category ?></p>
                <p class="text-sm mb-2">Supervisor: <?php echo $supervisor; ?></p>
                <p class="text-sm mb-2">Progress: <?php echo $Progress ?>%</p>
                <p class="text-sm mb-2">Discription: <?php echo $Description; ?></p>
                <?php if ($Adoption_Authority == ' ') : ?>
                  <p class="text-sm mb-2">Adoption Authority: <?php echo $Adoption_Authority ?></p>
                <?php endif ?>

                <?php if (isset($Documentation)) : ?>
                  <p class="text-sm mb-2">View Documentation: <?php echo $Documentation ?></p>
                <?php endif ?>
              </div>
            </div>
          <?php endif ?>




      <?php
        }
      } else {
        echo "لايوجد   ";
      }

      $conn->close();
      ?>


    </div>

    <div class="flex justify-between items-center mb-4">
      <span>List of upcoming activities at the university</span>

    </div>
    <!-- Table Placeholder -->
    <div class="border border-gray-300 p-4">
      <div class="footer">
        <p class="text-sm text-gray-500 mb-2">contact with college: IT@ouk.org</p>
        <p class="text-sm text-gray-500 mb-2">phone number: +964777777777</p>
        <p class="text-sm text-gray-900 mb-2 b-5">Copyright © 2024 UB All Rights Reserved</p>
      </div>
    </div>
  </main>

  <script>
    // Get the user icon button and dropdown
    const userIcon = document.getElementById('user-icon');
    const userDropdown = document.getElementById('user-dropdown');

    // Toggle the dropdown menu when user clicks the user icon
    userIcon.addEventListener('click', function() {
      userDropdown.classList.toggle('hidden');
    });

    // Optionally, close the dropdown if the user clicks outside of it
    window.addEventListener('click', function(event) {
      if (!userIcon.contains(event.target) && !userDropdown.contains(event.target)) {
        userDropdown.classList.add('hidden');
      }
    });
  </script>
</body>



</html>
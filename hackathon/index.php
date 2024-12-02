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
        <a href="index.html">
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
    

<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام لاسترداد البيانات
$sql = "SELECT title_en,title_ar,supervisor,description,progress,adoption_authority,documintation,members.name_1,members.name_2,members.name_3,
members.name_4,images.image_1,images.image_2,images.image_3,images.image_4,users.first_name,users.last_name,category.name FROM projects
JOIN members on(projects.members_id=members.members_id)
JOIN images on (projects.images_id=images.images_id)
JOIN users on (projects.user_id=users.user_id)
JOIN category on (projects.cat_id=category.category_id)";

$result = $conn->query($sql);


              if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
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


    
    <!-- Projects List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
      
      <!-- Example Project Card -->
      <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">
        <!-- Left Section: Images and Project Details -->
        <div class="flex flex-wrap gap-4 mb-4">
          <img src="image1.jpg" alt="Project Image 1" class="w-32 h-32 object-cover rounded">
          <img src="image2.jpg" alt="Project Image 2" class="w-32 h-32 object-cover rounded">
          <img src="image3.jpg" alt="Project Image 3" class="w-32 h-32 object-cover rounded">
          <img src="image4.jpg" alt="Project Image 4" class="w-32 h-32 object-cover rounded">
        </div>

        <!-- Project Information -->
        <div class="flex-1">
          <h3  class="text-lg font-semibold mb-2"><?php echo $title_en; ?>  </p></h3>
          <p  class="text-sm text-gray-500 mb-2"><?php echo $title_ar; ?>  </p></p>
          <p  class="text-sm mb-2"><?php echo  $category ?></p>
          <p  class="text-sm mb-2"><?php echo $supervisor; ?>  </p></p>
          <p  class="text-sm mb-2"><?php echo $Description; ?></p>
          <p  class="text-sm mb-2"><?php echo $Progress ?></p>
          <p  class="text-sm mb-2"><?php echo $Adoption_Authority ?></p>
          <p  class="text-sm mb-2"><?php echo $Documentation ?></p>
          <p  class="text-sm mb-2"><?php echo $members_1 ?></p>
          <p  class="text-sm mb-2"><?php echo $members_2 ?></p>
          <p  class="text-sm mb-2"><?php echo $members_3 ?></p>
          <p  class="text-sm mb-2"><?php echo $members_4?></p>
          <p  class="text-sm mb-2"><?php echo $images_1 ?></p>
          <p  class="text-sm mb-2"><?php echo $images_2 ?></p>
          <p  class="text-sm mb-2"><?php echo $images_3 ?></p>
          <p  class="text-sm mb-2"><?php echo $images_4 ?></p>
          <p  class=""><?php echo $Leader_f ," ", $Leader_l?></p>  
         
     

          

        </div>
      </div>


      
    </div>

    <?php
                }
              } else {
                echo "لايوجد   ";
              }

              $conn->close();
              ?>




    <div class="flex justify-between items-center mb-4">
      <span>List of upcoming activities at the university</span>
      <input class="border border-gray-300 px-2 py-1" placeholder="Search:" type="text" />
    </div>
    <!-- Table Placeholder -->
    <div class="border border-gray-300 p-4">
      <div class="projects"></div>
    </div>
  </main>

  <script src="server/view.js"></script>
</body>



</html>

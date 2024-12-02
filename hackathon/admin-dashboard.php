<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT project_id, title_en, title_ar, supervisor, description, progress, adoption_authority, documintation, approval,
                    members.name_1, members.name_2, members.name_3, members.name_4, 
                    images.image_1, images.image_2, images.image_3, images.image_4, 
                    users.first_name, users.last_name, category.name 
                    FROM projects
                    JOIN members ON (projects.members_id = members.members_id)
                    JOIN images ON (projects.images_id = images.images_id)
                    JOIN users ON (projects.user_id = users.user_id)
                    JOIN category ON (projects.cat_id = category.category_id);";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-200">

    <!-- Header (same as index page) -->
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-2xl font-bold"><a href="index.php">University of Kerbala</a></div>
            <div class="flex items-center space-x-4">
                <a href="index.php" class="text-white hover:text-gray-400">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <a href="login.html" class="text-white hover:text-gray-400">
                    <i class="fas fa-user text-xl"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- Button to switch between forms -->
    <div class="flex justify-center mt-4 space-x-4">
        <!-- Pending button (Blue) -->
        <button onclick="toggleForm('pending')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 transition">
            Pending
        </button>

        <!-- Approved button (Green) -->
        <button onclick="toggleForm('approved')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 transition">
            Approved
        </button>

        <!-- Declined button (Red) -->
        <button onclick="toggleForm('declined')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300 transition">
            Declined
        </button>
    </div>

    <!-- Admin Dashboard -->
    <div id="pending" class="container mx-auto py-8 pending">
        <h2 class="text-2xl font-bold mb-4">Pending</h2>

        <!-- Projects List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach ($result as $project) : ?>
                <?php if ($project['approval'] === NULL) : ?>
                    <!-- Example Project Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">
                        <!-- Left Section: Images and Project Details -->
                        <div class="flex flex-wrap gap-4 mb-4">
                            <img src="<?php echo $project['image_1'] ?>" alt="Project Image 1" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_2'] ?>" alt="Project Image 2" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_3'] ?>" alt="Project Image 3" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $$project['image_4'] ?>" alt="Project Image 4" class="w-32 h-32 object-cover rounded">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold mb-2"><?php echo $project['title_en']; ?></h3>
                            <p class="text-sm text-gray-500 mb-2"><?php echo $project['title_ar']; ?></p>
                            <p class="text-sm mb-2">Category: <?php echo $project['name']; ?></p>
                            <p class="text-sm mb-2">Supervisor: <?php echo $project['supervisor']; ?></p>
                            <p class="text-sm mb-2">Leader: <?php echo $project['first_name'], " ", $project['last_name'] ?></p>
                            <p class="text-sm mb-2">Members: <?php echo $project['name_1'] ?>, <?php echo $project['name_2'] ?>, <?php echo $project['name_3'] ?>, <?php echo $project['name_4'] ?></p>
                            <p class="text-sm mb-2">Progress: <?php echo $project['progress'] ?>%</p>
                            <p class="text-sm mb-2">Description: <?php echo $project['description']; ?></p>
                            <p class="text-sm mb-2">Adoption Authority: <?php echo $project['adoption_authority'] ?></p>
                            <p class="text-sm mb-2">View Documentation: <?php echo $project['documintation']; ?></p>
                        </div>

                        <!-- Right Section: Approve and Delete buttons -->
                        <div class="mt-auto flex justify-between space-x-4">
                            <form action='process-approval.php' method='POST'>
                                <input type='hidden' name='project_id' value='<?= $project['project_id']; ?>'>
                                <button onclick="approveProject()" value='approve' name='action' class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition w-full text-center">Approve</button>
                            </form>
                            <form action='process-approval.php' method='POST'>
                                <input type='hidden' name='project_id' value='<?= $project['project_id']; ?>'>
                                <button onclick="deleteProject()" value='decline' name='action' class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition w-full text-center">Decline</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="approved" class="container mx-auto py-8 approved">
        <h2 class="text-2xl font-bold mb-4">Approved</h2>

        <!-- Projects List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach ($result as $project) : ?>
                <?php if ($project['approval'] === "1") : ?>
                    <!-- Example Project Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">
                        <!-- Left Section: Images and Project Details -->
                        <div class="flex flex-wrap gap-4 mb-4">
                            <img src="<?php echo $project['image_1'] ?>" alt="Project Image 1" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_2'] ?>" alt="Project Image 2" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_3'] ?>" alt="Project Image 3" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $$project['image_4'] ?>" alt="Project Image 4" class="w-32 h-32 object-cover rounded">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold mb-2"><?php echo $project['title_en']; ?></h3>
                            <p class="text-sm text-gray-500 mb-2"><?php echo $project['title_ar']; ?></p>
                            <p class="text-sm mb-2">Category: <?php echo $project['name']; ?></p>
                            <p class="text-sm mb-2">Supervisor: <?php echo $project['supervisor']; ?></p>
                            <p class="text-sm mb-2">Leader: <?php echo $project['first_name'], " ", $project['last_name'] ?></p>
                            <p class="text-sm mb-2">Members: <?php echo $project['name_1'] ?>, <?php echo $project['name_2'] ?>, <?php echo $project['name_3'] ?>, <?php echo $project['name_4'] ?></p>
                            <p class="text-sm mb-2">Progress: <?php echo $project['progress'] ?>%</p>
                            <p class="text-sm mb-2">Description: <?php echo $project['description']; ?></p>
                            <p class="text-sm mb-2">Adoption Authority: <?php echo $project['adoption_authority'] ?></p>
                            <p class="text-sm mb-2">View Documentation: <?php echo $project['documintation']; ?></p>
                        </div>

                        <!-- Right Section: Approve and Delete buttons -->
                        <div class="mt-auto flex justify-between space-x-4">
                            <form action='process-approval.php' method='POST'>
                                <input type='hidden' name='project_id' value='<?= $project['project_id']; ?>'>
                                <button onclick="deleteProject()" value='decline' name='action' class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition w-full text-center">Decline</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="declined" class="container mx-auto py-8 declined">
        <h2 class="text-2xl font-bold mb-4">Declined</h2>

        <!-- Projects List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach ($result as $project) : ?>
                <?php if ($project['approval'] === "0") : ?>
                    <!-- Example Project Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 flex flex-col">
                        <!-- Left Section: Images and Project Details -->
                        <div class="flex flex-wrap gap-4 mb-4">
                            <img src="<?php echo $project['image_1'] ?>" alt="Project Image 1" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_2'] ?>" alt="Project Image 2" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $project['image_3'] ?>" alt="Project Image 3" class="w-32 h-32 object-cover rounded">
                            <img src="<?php echo $$project['image_4'] ?>" alt="Project Image 4" class="w-32 h-32 object-cover rounded">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold mb-2"><?php echo $project['title_en']; ?></h3>
                            <p class="text-sm text-gray-500 mb-2"><?php echo $project['title_ar']; ?></p>
                            <p class="text-sm mb-2">Category: <?php echo $project['name']; ?></p>
                            <p class="text-sm mb-2">Supervisor: <?php echo $project['supervisor']; ?></p>
                            <p class="text-sm mb-2">Leader: <?php echo $project['first_name'], " ", $project['last_name'] ?></p>
                            <p class="text-sm mb-2">Members: <?php echo $project['name_1'] ?>, <?php echo $project['name_2'] ?>, <?php echo $project['name_3'] ?>, <?php echo $project['name_4'] ?></p>
                            <p class="text-sm mb-2">Progress: <?php echo $project['progress'] ?>%</p>
                            <p class="text-sm mb-2">Description: <?php echo $project['description']; ?></p>
                            <p class="text-sm mb-2">Adoption Authority: <?php echo $project['adoption_authority'] ?></p>
                            <p class="text-sm mb-2">View Documentation: <?php echo $project['documintation']; ?></p>
                        </div>

                        <!-- Right Section: Approve and Delete buttons -->
                        <div class="mt-auto flex justify-between space-x-4">
                        <form action='process-approval.php' method='POST'>
                                <input type='hidden' name='project_id' value='<?= $project['project_id']; ?>'>
                                <button onclick="approveProject()" value='approve' name='action' class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition w-full text-center">Approve</button>
                            </form>                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Function to simulate project approval (you can add actual backend logic here)
        function approveProject() {
            const confirmed = confirm("Are you sure you want to approve this project?");
            if (confirmed) {
                alert("Project approved successfully!");
                // Implement project approval logic here (e.g., update database status)
            }
        }

        // Function to simulate project deletion (you can add actual backend logic here)
        function deleteProject() {
            const confirmed = confirm("Are you sure you want to delete this project?");
            if (confirmed) {
                alert("Project deleted successfully!");
                // Implement project deletion logic here (e.g., AJAX request to backend)
            }
        }

        // Toggle between sections based on button clicks
        function toggleForm(formType) {
            const approved = document.getElementById('approved');
            const pending = document.getElementById('pending');
            const declined = document.getElementById('declined');

            // Hide all sections initially
            pending.classList.add('hidden');
            approved.classList.add('hidden');
            declined.classList.add('hidden');

            // Show the selected section
            if (formType === 'pending') {
                pending.classList.remove('hidden');
            } else if (formType === 'approved') {
                approved.classList.remove('hidden');
            } else if (formType === 'declined') {
                declined.classList.remove('hidden');
            }
        }

        // Set default form as 'pending' when the page loads
        window.onload = function() {
            toggleForm('pending');
        }
    </script>

</body>

</html>
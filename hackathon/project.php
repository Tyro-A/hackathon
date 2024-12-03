<?php
session_start();
require 'connection.php';

// Get the project ID from the URL
if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Fetch project details from the database
    $sql = "SELECT project_id, title_en, title_ar, supervisor, description, progress, adoption_authority, documintation,
            members.name_1, members.name_2, members.name_3, members.name_4,
            images.image_1, images.image_2, images.image_3, images.image_4,
            users.first_name, users.last_name, category.name, approval
            FROM projects
            JOIN members ON projects.members_id = members.members_id
            JOIN images ON projects.images_id = images.images_id
            JOIN users ON projects.user_id = users.user_id
            JOIN category ON projects.cat_id = category.category_id
            WHERE projects.project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        echo "Project not found.";
        exit;
    }
} else {
    echo "Invalid project.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['title_en']); ?> | Project Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- Add Tailwind & FontAwesome scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>

<body class="bg-gray-100">

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


    <!-- Project Details -->
    <div class="container mx-auto p-6 bg-white mt-6 shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($project['title_en']); ?></h2>
        <h3 class="text-xl text-gray-500 mb-6"><?php echo htmlspecialchars($project['title_ar']); ?></h3>

        <!-- Images Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <?php for ($i = 1; $i <= 4; $i++) :
                $image = $project["image_$i"];
                if (!empty($image)) : ?>
                    <a href="<?php echo htmlspecialchars($image); ?>" class="image-link">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Project Image <?php echo $i; ?>" class="w-full h-40 object-cover rounded-lg shadow">
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Modal for Lightbox -->
        <div id="lightbox-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
            <img id="lightbox-image" src="" alt="Enlarged Project Image" class="max-w-full max-h-full rounded-lg">
            <button id="lightbox-close" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
        </div>


        <!-- Project Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div>
                <h4 class="text-lg font-bold">Supervisor</h4>
                <p><?php echo htmlspecialchars($project['supervisor']); ?></p>
            </div>
            <div>
                <h4 class="text-lg font-bold">Category</h4>
                <p><?php echo htmlspecialchars($project['name']); ?></p>
            </div>
            <div>
                <h4 class="text-lg font-bold">Progress</h4>
                <p><?php echo htmlspecialchars($project['progress']); ?>%</p>
            </div>
            <div>
                <h4 class="text-lg font-bold">Adoption Authority</h4>
                <p><?php echo htmlspecialchars($project['adoption_authority']); ?></p>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-bold">Description</h4>
            <p><?php echo htmlspecialchars($project['description']); ?></p>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-bold">Documentation</h4>
            <a href="<?php echo htmlspecialchars($project['documintation']); ?>" class="text-blue-500 hover:underline" target="_blank">View Documentation</a>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-bold">Team Members</h4>
            <ul>
                <?php for ($i = 1; $i <= 4; $i++) :
                    $member = $project["name_$i"];
                    if (!empty($member)) : ?>
                        <li><?php echo htmlspecialchars($member); ?></li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-6">
        <div class="container mx-auto py-4 px-6 text-center">
            <p>© <?php echo date("Y"); ?> University of Kerbala</p>
        </div>
    </footer>
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
    <script>
        const lightboxModal = document.getElementById('lightbox-modal');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxClose = document.getElementById('lightbox-close');
        const imageLinks = document.querySelectorAll('.image-link');

        imageLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const imageSrc = this.href;
                lightboxImage.src = imageSrc;
                lightboxModal.classList.remove('hidden');
            });
        });

        lightboxClose.addEventListener('click', function() {
            lightboxModal.classList.add('hidden');
        });

        // Close modal when clicking outside the image
        lightboxModal.addEventListener('click', function(event) {
            if (event.target === lightboxModal) {
                lightboxModal.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
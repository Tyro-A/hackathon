<?php
// Include database connection
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

 // Replace with your database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $project_id = $_POST['project_id'];
    $title_ar = $_POST['title_ar'];
    $title_en = $_POST['title_en'];
    $category = $_POST['category'];
    $supervisor = $_POST['supervisor'];
    $leader = $_POST['leader'];
    $members_id = $_POST['members_id'];
    $name_1 = $_POST['name_1'];
    $name_2 = $_POST['name_2'];
    $name_3 = $_POST['name_3'];
    $name_4 = $_POST['name_4'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $adoptingAuthority = $_POST['adoptingAuthority'];


    // Build SQL query
    $sql = "UPDATE projects SET 
        title_ar = ?,
        title_en = ?,
        supervisor = ?,
        description = ?,
        progress = ?,
        adoption_authority = ?
    WHERE project_id = ?";

    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            'ssssisi',
            $title_ar,
            $title_en,
            $supervisor,
            $description,
            $progress,
            $adoptingAuthority,
            $project_id
        );

        // Execute query
        if ($stmt->execute()) {
            echo "Record updated successfully!";
            // Redirect or show success message
            
            header("Location: user-dashboard.php"); // Replace with your success page
        } 

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid request method!";
}
?>


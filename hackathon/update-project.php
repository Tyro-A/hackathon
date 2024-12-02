<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch inputs
    $project_id = intval($_POST['project_id']);
    $title_ar = $conn->real_escape_string($_POST['title_ar']);
    $title_en = $conn->real_escape_string($_POST['title_en']);
    $category_id = intval($_POST['category']);
    $supervisor = $conn->real_escape_string($_POST['supervisor']);
    $leader = $conn->real_escape_string($_POST['leader']);
    $description = $conn->real_escape_string($_POST['description']);
    $progress = intval($_POST['progress']);
    $adopting_authority = $conn->real_escape_string($_POST['adoptingAuthority']);
    $members_id = intval($_POST['members_id']);
    $member_1 = $conn->real_escape_string($_POST['name_1']);
    $member_2 = $conn->real_escape_string($_POST['name_2']);
    $member_3 = $conn->real_escape_string($_POST['name_3']);
    $member_4 = $conn->real_escape_string($_POST['name_4']);

    // Images handling
    $image_fields = ['image1', 'image2', 'image3', 'image4'];
    $image_updates = [];
    foreach ($image_fields as $key => $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $image_name = basename($_FILES[$field]['name']);
            $target_dir = "uploads/";
            $target_file = $target_dir . $image_name;

            // Upload file
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $target_file)) {
                $image_updates[$field] = $target_file;
            }
        }
    }

    // Update `members` table
    $sql_members = "
        UPDATE members
        SET name_1 = '$member_1', name_2 = '$member_2', name_3 = '$member_3', name_4 = '$member_4'
        WHERE members_id = $members_id
    ";

    if (!$conn->query($sql_members)) {
        die("Error updating members: " . $conn->error);
    }

    // Update `images` table if new images were uploaded
    if (!empty($image_updates)) {
        $image_set_statements = [];
        foreach ($image_updates as $field => $file_path) {
            $column_name = str_replace('image', 'image_', $field); // Map field names to DB column names
            $image_set_statements[] = "$column_name = '$file_path'";
        }
        $image_set_query = implode(', ', $image_set_statements);
        $sql_images = "UPDATE images SET $image_set_query WHERE images_id = (SELECT images_id FROM projects WHERE project_id = $project_id)";

        if (!$conn->query($sql_images)) {
            die("Error updating images: " . $conn->error);
        }
    }

    // Update `projects` table
    $sql_project = "
        UPDATE projects
        SET title_ar = '$title_ar',
            title_en = '$title_en',
            supervisor = '$supervisor',
            description = '$description',
            progress = $progress,
            adoption_authority = '$adopting_authority'
            
        WHERE project_id = $project_id
    ";

    if (!$conn->query($sql_project)) {
        die("Error updating project: " . $conn->error);
    }

    // Redirect or confirm success
    header('Location: edit-project.php?project_id=' . $project_id . '&success=1');
    exit();
} else {
    // If accessed without POST data, redirect to the form page
    header('Location: edit-project.php');
    exit();
}

$conn->close();

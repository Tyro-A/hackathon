<?php
session_start();
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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title_ar = $conn->real_escape_string($_POST['title_ar']);
    $title_en = $conn->real_escape_string($_POST['title_en']);
    $supervisor = $conn->real_escape_string($_POST['supervisor']);
    $description = $conn->real_escape_string($_POST['description']);
    $progress = (int)$_POST['progress'];
    $adoptingAuthority = $conn->real_escape_string($_POST['adoptingAuthority']);
    $category_name = $conn->real_escape_string($_POST['category']);
    $name_1 = $conn->real_escape_string($_POST['name_1']);
    $name_2 = $conn->real_escape_string($_POST['name_2']);
    $name_3 = $conn->real_escape_string($_POST['name_3']);
    $name_4 = $conn->real_escape_string($_POST['name_4']);
    $user_id = (int)$_SESSION['user_id'];

    $upload_dir = 'uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $image_1 = $image_2 = $image_3 = $image_4 = '';

    try {
        if (isset($_FILES['image_1']) && $_FILES['image_1']['error'] == UPLOAD_ERR_OK) {
            $image_1 = $upload_dir . basename($_FILES['image_1']['name']);
            if (!move_uploaded_file($_FILES['image_1']['tmp_name'], $image_1)) {
                throw new Exception("Failed to upload image_1");
            }
        }

        if (isset($_FILES['image_2']) && $_FILES['image_2']['error'] == UPLOAD_ERR_OK) {
            $image_2 = $upload_dir . basename($_FILES['image_2']['name']);
            if (!move_uploaded_file($_FILES['image_2']['tmp_name'], $image_2)) {
                throw new Exception("Failed to upload image_2");
            }
        }

        if (isset($_FILES['image_3']) && $_FILES['image_3']['error'] == UPLOAD_ERR_OK) {
            $image_3 = $upload_dir . basename($_FILES['image_3']['name']);
            if (!move_uploaded_file($_FILES['image_3']['tmp_name'], $image_3)) {
                throw new Exception("Failed to upload image__3");
            }
        }

        if (isset($_FILES['image_4']) && $_FILES['image_4']['error'] == UPLOAD_ERR_OK) {
            $image_4 = $upload_dir . basename($_FILES['image_4']['name']);
            if (!move_uploaded_file($_FILES['image_4']['tmp_name'], $image_4)) {
                throw new Exception("Failed to upload image_4");
            }
        }

        // Start transaction
        $conn->begin_transaction();

        // Insert into `members`
        $sql = "INSERT INTO members (name_1, name_2, name_3, name_4) 
                VALUES ('$name_1', '$name_2', '$name_3', '$name_4')";
        $conn->query($sql);
        $members_id = $conn->insert_id;

        // Insert into `images`
        $sql = "INSERT INTO images (image_1, image_2, image_3, image_4) 
                VALUES ('$image_1', '$image_2', '$image_3', '$image_4')";
        if (!$conn->query($sql)) {
            throw new Exception("Database error: " . $conn->error);
        }
        $images_id = $conn->insert_id;

        // Insert into `category`
        $sql = "SELECT category_id FROM category WHERE name = '$category_name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $category_id = $result->fetch_assoc()['category_id'];
        } else {
            $sql = "INSERT INTO category (name) VALUES ('$category_name')";
            $conn->query($sql);
            $category_id = $conn->insert_id;
        }

        // Insert into `projects`
        $sql = "INSERT INTO projects (title_ar, title_en, supervisor, description, progress, adoption_authority, members_id, images_id, user_id, cat_id) 
                VALUES ('$title_ar', '$title_en', '$supervisor', '$description', $progress, '$adoptingAuthority', $members_id, $images_id, $user_id, $category_id)";
        $conn->query($sql);

        $conn->commit();
        echo "Data added successfully.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

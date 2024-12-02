<?php
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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from the form
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
    $image_1 = $conn->real_escape_string($_POST['image1']);
    $image_2 = $conn->real_escape_string($_POST['image2']);
    $image_3 = $conn->real_escape_string($_POST['image3']);
    $image_4 = $conn->real_escape_string($_POST['image4']);
    // $user_id = (int)$_POST['user_id']; // Ensure user_id is provided in the form

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into `members` table
        $sql = "INSERT INTO members (name_1, name_2, name_3, name_4) 
                VALUES ('$name_1', '$name_2', '$name_3', '$name_4')";
        $conn->query($sql);
        $members_id = $conn->insert_id;

        // Insert into `images` table
        $sql = "INSERT INTO images (image_1, image_2, image_3, image_4) 
                VALUES ('$image_1', '$image_2', '$image_3', '$image_4')";
        $conn->query($sql);
        $images_id = $conn->insert_id;

        // Insert into `category` table if it doesn't exist
        $sql = "SELECT category_id FROM category WHERE name = '$category_name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $category_id = $result->fetch_assoc()['category_id'];
        } else {
            $sql = "INSERT INTO category (name) VALUES ('$category_name')";
            $conn->query($sql);
            $category_id = $conn->insert_id;
        }

        // Insert into `projects` table
        $sql = "INSERT INTO projects (title_ar, title_en, supervisor, description, progress, adoption_authority, members_id, images_id, user_id, cat_id) 
                VALUES ('$title_ar', '$title_en', '$supervisor', '$description', $progress, '$adoptingAuthority', $members_id, $images_id, 1, $category_id)";
        $conn->query($sql);

        // Commit transaction
        $conn->commit();
        echo "Data added successfully.";
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

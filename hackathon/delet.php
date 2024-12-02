<?php

$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM doctors WHERE id = ?";

       
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

      
        if ($stmt->execute()) {
           
            echo "successful deletion: " . $conn->error;
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

       
        $stmt->close();
    }













?>
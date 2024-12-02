<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost'; // Change as needed
$dbname = 'your_database'; // Replace with your DB name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];
$userData = $data['data'];

if ($action === 'login') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $userData['username']);
    $stmt->bindParam(':password', $userData['password']); // Use hashing for production
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'redirectUrl' => 'user-dashboard.html']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    }
} elseif ($action === 'register') {
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, college, department, is_graduated, graduation_year, password) 
                            VALUES (:name, :email, :phone, :college, :department, :is_graduated, :graduation_year, :password)");

    $stmt->bindParam(':name', $userData['name']);
    $stmt->bindParam(':email', $userData['email']);
    $stmt->bindParam(':phone', $userData['phone']);
    $stmt->bindParam(':college', $userData['college']);
    $stmt->bindParam(':department', $userData['department']);
    $stmt->bindParam(':is_graduated', $userData['isGraduated']);
    $stmt->bindParam(':graduation_year', $userData['graduationYear']);
    $stmt->bindParam(':password', $userData['password']); // Use hashing for production

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
?>

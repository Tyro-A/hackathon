<?php
// Start the session to handle login
session_start();

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "project";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw POST data from the client
$input = json_decode(file_get_contents('php://input'), true);

if ($input['action'] === 'login') {
    // Handle login logic
    $username = $input['data']['username'];
    $password = $input['data']['password'];

    // Validate user credentials from the database
    $sql = "SELECT user_id, first_name, last_name FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, set session data
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        
        // Respond with a success message and redirect URL
        echo json_encode([
            'success' => true,
            'redirectUrl' => 'user-dashboard.php', // Redirect to the user dashboard
        ]);
    } else {
        // Invalid credentials
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email or password.',
        ]);
    }
} elseif ($input['action'] === 'register') {
    // Handle registration logic
    $name = $input['data']['name'];
    $email = $input['data']['email'];
    $phone = $input['data']['phone'];
    $college = $input['data']['college'];
    $department = $input['data']['department'];
    $isGraduated = $input['data']['isGraduated'];
    $graduationYear = $input['data']['graduationYear'];
    $password = $input['data']['password'];

    // Check if the email already exists
    $sql = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo json_encode([
            'success' => false,
            'message' => 'Email is already registered.',
        ]);
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (name, email, phone, college, department, is_graduated, graduation_year, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $name, $email, $phone, $college, $department, $isGraduated, $graduationYear, $password);

        if ($stmt->execute()) {
            // Successful registration
            echo json_encode([
                'success' => true,
                'message' => 'Registration successful!',
            ]);
        } else {
            // Database error
            echo json_encode([
                'success' => false,
                'message' => 'Registration failed. Please try again.',
            ]);
        }
    }
} else {
    // Invalid action
    echo json_encode([
        'success' => false,
        'message' => 'Invalid action.',
    ]);
}

$conn->close();
?>

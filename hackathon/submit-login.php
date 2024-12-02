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
    $sql = "SELECT user_id, first_name, last_name, is_admin FROM users WHERE email = ? AND password = ?";
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
        $_SESSION['is_admin'] = $row['is_admin'];
        if ($_SESSION['is_admin'] == 1) {
            echo json_encode([
                'success' => true,
                'redirectUrl' => 'admin-dashboard.php', // Redirect to the user dashboard
            ]);
        } else if ($_SESSION['is_admin'] == 0) {
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
    }
    // Respond with a success message and redirect URL

} else{
    // Handle registration logic
    $name = $input['data']['name'];
    $email = $input['data']['email'];
    $phone = $input['data']['phone'];
    $college = $input['data']['college'];
    $department = $input['data']['department'];
    $isGraduated = $input['data']['isGraduated'];
    $graduationYear = $input['data']['graduationYear'];
    $password = $input['data']['password'];

    // Insert user data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, phone, college, department, is_graduated, graduated_year, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Assuming the name is first and last name (split by space)
    $nameParts = explode(' ', $name);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssiss", $firstName, $lastName, $email, $phone, $college, $department, $isGraduated, $graduationYear, $password);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Registration successful!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Registration failed. Please try again.',
        ]);
    }

    $stmt->close();
}

$conn->close();
?>
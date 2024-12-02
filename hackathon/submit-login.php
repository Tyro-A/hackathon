<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = '127.0.0.1';
$dbname = 'project';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
}

// Get POST data
$requestPayload = file_get_contents('php://input');
$request = json_decode($requestPayload, true);

if (!$request || !isset($request['action'], $request['data'])) {
    die(json_encode(['success' => false, 'message' => 'Invalid request.']));
}

$action = $request['action'];
$data = $request['data'];

if ($action === 'login') {
    $email = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    // Validate email and password
    if (empty($email) || empty($password)) {
        die(json_encode(['success' => false, 'message' => 'Email and password are required.']));
    }

    try {
        // Query the database for the user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password'] === $password) {
            // Check if user is admin
            $isAdmin = $user['is_admin'] == 1;

            // Redirect URLs
            $redirectUrl = $isAdmin ? 'admin-dashboard.html' : 'user-dashboard.html';

            die(json_encode([
                'success' => true,
                'redirectUrl' => $redirectUrl
            ]));
        } else {
            die(json_encode(['success' => false, 'message' => 'Invalid email or password.']));
        }
    } catch (PDOException $e) {
        die(json_encode(['success' => false, 'message' => 'Database query failed: ' . $e->getMessage()]));
    }
} elseif ($action === 'register') {
    // Registration logic
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $college = $data['college'] ?? '';
    $department = $data['department'] ?? '';
    $isGraduated = $data['isGraduated'] === 'yes' ? 1 : 0;
    $graduationYear = $data['graduationYear'] ?? null;
    $password = $data['password'] ?? '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($college) || empty($department) || empty($password)) {
        die(json_encode(['success' => false, 'message' => 'All fields are required.']));
    }

    try {
        // Insert the new user into the database
        $stmt = $pdo->prepare("
            INSERT INTO users (first_name, email, phone, college, department, is_graduated, graduated_year, password, is_admin)
            VALUES (:name, :email, :phone, :college, :department, :is_graduated, :graduationYear, :password, 0)
        ");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'college' => $college,
            'department' => $department,
            'is_graduated' => $isGraduated,
            'graduationYear' => $graduationYear,
            'password' => $password
        ]);

        die(json_encode(['success' => true]));
    } catch (PDOException $e) {
        die(json_encode(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()]));
    }
} else {
    die(json_encode(['success' => false, 'message' => 'Invalid action.']));
}
?>

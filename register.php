<?php
// Database connection settings — adjust to your own database credentials
$host = 'localhost';
$dbname = 'depanaz_db';
$username = 'your_db_user';
$password = 'your_db_password';

// Connect to MySQL database using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to sanitize input
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $first_name = sanitize($_POST['first_name'] ?? '');
    $last_name = sanitize($_POST['last_name'] ?? '');
    $vehicle_make = sanitize($_POST['vehicle_make'] ?? '');
    $vehicle_model = sanitize($_POST['vehicle_model'] ?? '');
    $vehicle_color = sanitize($_POST['vehicle_color'] ?? '');
    $registration_number = sanitize($_POST['registration_number'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($vehicle_make) || empty($vehicle_model) || empty($vehicle_color) || empty($registration_number) || empty($password) || empty($confirm_password)) {
        die("Error: All fields are required.");
    }

    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Hash the password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare and execute insert query
        $stmt = $pdo->prepare("INSERT INTO vehicle_registrations (first_name, last_name, vehicle_make, vehicle_model, vehicle_color, registration_number, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $vehicle_make, $vehicle_model, $vehicle_color, $registration_number, $password_hash]);

        echo "Registration successful! Thank you, $first_name.";
    } catch (PDOException $e) {
        // Handle duplicate registration number or other DB errors
        if ($e->getCode() == 23000) { // Integrity constraint violation (e.g. duplicate key)
            echo "Error: This registration number is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // Not a POST request
    echo "Invalid request method.";
}
?>

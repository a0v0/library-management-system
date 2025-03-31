<?php
header("Content-Type: application/json");


require "db.php"; // Include database connection
require "logger.php";

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = mysqli_real_escape_string($conn, trim($data["username"]));
    $email = mysqli_real_escape_string($conn, trim($data["email"]));
    $password = mysqli_real_escape_string($conn, trim($data["password"]));
    $role = mysqli_real_escape_string($conn, trim($data["role"]));

    // Check if email already exists
    $checkEmailQuery = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(["error" => "Email already registered. Please log in."]);
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $insertQuery = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(["message" => "Signup successful!"]);
    } else {
        echo json_encode(["error" => "Signup failed: " . mysqli_error($conn)]);
    }
}

// Close the connection
mysqli_close($conn);

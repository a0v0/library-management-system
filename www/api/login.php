<?php
header("Content-Type: application/json");
session_start();
include "db.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Read and decode JSON input
$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

// Check if JSON was decoded properly
if (!$data) {
    echo json_encode(["error" => "Invalid JSON input", "raw_input" => $rawInput]);
    exit;
}

// Extract email and password safely
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;

// Validate input
if (!$email || !$password) {
    echo json_encode(["error" => "Email and password are required."]);
    exit;
}

// Prevent SQL injection
$email = mysqli_real_escape_string($conn, $email);

// Fetch user from database
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => "Database error: " . mysqli_error($conn)]);
    exit;
}

$user = mysqli_fetch_assoc($result);

// Verify password
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = [
        "id" => $user['id'],
        "username" => $user['username'],
        "email" => $user['email'],
        "role" => $user['role']
    ];

    echo json_encode([
        "message" => "Login successful!",
        "user" => $_SESSION['user']
    ]); // ✅ Correct json_encode() format
} else {
    echo json_encode(["error" => "Invalid email or password."]);
}

mysqli_close($conn);

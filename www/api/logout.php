<?php
header("Content-Type: application/json");
session_start();

session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

echo json_encode(["message" => "Logout successful!"]);

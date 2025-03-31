<?php
session_start(); // Start session for all pages

$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "library_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

<?php
$servername = "mysql";
$username = "user";
$password = "password";
$dbname = "mydb";


$com = mysqli_connect($servername, $username, $password, $dbname,);
if (!$com) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
}

$name = $_POST['name'];

$sql = "INSERT INTO users (name) VALUES ('$name')";

if (mysqli_query($com, $sql)) {
    echo "Records added successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($com);
}

$com->close();

<?php
// Establish connection to your MySQL database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "schemeseva1"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve password from form submission
$password = $_POST['password'];

// You should perform further validation and sanitization here to prevent SQL injection

// Insert password into database
$sql = "INSERT INTO passwords (password) VALUES ('$password')";

if ($conn->query($sql) === TRUE) {
    header("Location:Dashboard.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

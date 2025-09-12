<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "recommendationhub";

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$message = $conn->real_escape_string($_POST['message']);

// Insert into contacts table
$sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
if ($conn->query($sql) === TRUE) {
  echo "Thanks $name! Your message has been received.";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>

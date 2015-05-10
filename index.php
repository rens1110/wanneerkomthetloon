<?php
$servername = "localhost";
$username = "root";
$password = "banana";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>

<html>
	<head>
	Wanneer komt het loon?
	</head>
	<body>
	<h1>Wanneer komt het loon?</h1>
	</body>
</html>
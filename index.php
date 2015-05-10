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
// echo "Connected successfully";
?>

<html>
	<head>
		<title>Wanneer komt het loon?</title>
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js" >
	</head>
	<body>
		<h1>Wanneer komt het loon?</h1>
	</body>
</html>
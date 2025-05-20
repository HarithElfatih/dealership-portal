<?php
$config = parse_ini_file("config.env");
$servername = $config['DB_HOST'];
$portNumber = $config['DB_PORT'];
$db_name = $config["DB_NAME"];

$username = $config["DB_USER"];
$password = $config["DB_PASS"];

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name, $portNumber);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";
?>
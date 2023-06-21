<?php
$servername = "localhost";
$username = "mpatharapo_patharapon";
$password = "cT9G7V6R8WaGSnNwP";
$dbname = "mpatharapo_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";
?>

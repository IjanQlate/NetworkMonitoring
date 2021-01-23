<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "networkmonitoring";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
?>
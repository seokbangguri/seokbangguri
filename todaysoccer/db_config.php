<?php
$servername = "localhost";
$username = "seokbangguri";
$password = "dlaoehdrodtmxj1!";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

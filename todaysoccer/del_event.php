<?php
include 'db_config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$title = $_GET['delete_title'];

$sql = "delete from events where title = '$title'";
$result = $conn->query($sql);

if ($result) {
  echo json_encode(['message' => 'Event deleted successfully']);
} else {
  echo json_encode(['message' => 'Error deleting event']);
}

$conn->close();
?>


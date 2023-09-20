<?php
include 'db_config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$teamimg = $_POST['teamimg'];

$sql = "SELECT * FROM news WHERE team = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $teamimg);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($events, $row);
  }
  echo json_encode($events);
} else {
  echo json_encode(['message' => 'No events found']);
}

$stmt->close();
$conn->close();
?>

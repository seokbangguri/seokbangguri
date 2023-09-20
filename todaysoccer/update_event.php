<?php
include 'db_config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$id = $_POST['id'];
$team = $_POST['team'];

$sql = "UPDATE user SET team = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $team, $id);
$stmt->execute();
$result = $stmt->get_result();

$user = [];

if ($result) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>


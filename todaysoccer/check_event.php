<?php
include 'db_config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$title = $_POST['title'];
$description = $_POST['description'];

$sql = "SELECT * FROM user WHERE id = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $title, $description);
$stmt->execute();
$result = $stmt->get_result();

$user = [];

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		array_push($user, $row);
	}
//	echo json_encode(['success' => true]);
	echo json_encode($user);
} else {
  echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>


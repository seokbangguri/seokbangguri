<?php
// 데이터베이스 연결 정보
$servername = "localhost";
$username = "seokbangguri";
$password = "dlaoehdrodtmxj1!";
$dbname = "test";

// 입력 폼에서 전송된 데이터 받기
$name = $_POST["name"];
$email = $_POST["email"];

// 데이터베이스 연결
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// INSERT 쿼리 실행
	$sql = "INSERT INTO ex1 (name, email) VALUES ('$name', '$email')";
	$conn->exec($sql);

	echo "Data successfully inserted.";
} catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

$conn = null;
?>


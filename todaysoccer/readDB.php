<?php

// 데이터베이스 연결 정보
$host = 'localhost';
$user = 'seokbangguri';
$pass = 'dlaoehdrodtmxj1!';
$db = 'test';

// 데이터베이스 연결
$conn = mysqli_connect($host, $user, $pass, $db);

// 연결 오류 발생 시 스크립트 중단
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// 쿼리 작성 및 실행
$sql = "SELECT * FROM ex1";
$result = mysqli_query($conn, $sql);

// 결과를 배열 형태로 변환
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

// JSON 형태로 반환
echo json_encode($rows);

// 연결 종료
mysqli_close($conn);

?>


<?php

// MySQL 데이터베이스 연결 설정
$servername = 'localhost';
$username = 'seokbangguri';
$password = 'dlaoehdrodtmxj1!';
$dbname = 'test';

// MySQL에 연결
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 연결 확인
if (!$conn) {
    die('MySQL 연결 실패: ' . mysqli_connect_error());
}

// 'ranking' 테이블에서 데이터 가져오기
$sql = 'SELECT * FROM news';
$result = mysqli_query($conn, $sql);

// 가져온 데이터를 배열에 저장
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// 연결 닫기
mysqli_close($conn);

// JSON 형식으로 변환
$jsonData = json_encode($data);

// HTTP 헤더 설정
header('Content-Type: application/json');

// JSON 응답 전송
echo $jsonData;

?>

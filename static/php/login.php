<?php
session_start(); // 세션 시작

// 데이터베이스 연결 정보
$servername = "localhost";
$username = "your_username"; // 실제 사용자명으로 변경
$password = "your_password"; // 실제 비밀번호로 변경
$dbname = "your_database"; // 실제 데이터베이스명으로 변경

// POST 데이터로부터 입력받은 사용자명과 비밀번호 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST["username"];
  $pass = $_POST["password"];
  
  // 데이터베이스 연결
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // 연결 확인
  if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
  }
  
  // 사용자명과 비밀번호 대조
  $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // 로그인 성공
    $_SESSION["username"] = $user; // 세션에 사용자명 저장
    echo "로그인 성공!";
  } else {
    // 로그인 실패
    echo "로그인 실패. 사용자명과 비밀번호를 확인하세요.";
  }
  
  // 연결 종료
  $conn->close();
}
?>

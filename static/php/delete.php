<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 데이터베이스 연결
  $servername = "localhost";
  $username = "seokbangguri"; // 실제 사용자명으로 변경
  $password = "dlaoehdrodtmxj1!"; // 실제 비밀번호로 변경
  $dbname = "ph"; // 실제 데이터베이스명으로 변경

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
  }

  // POST로 전달된 프로젝트명 가져오기
  $project_name = $_POST["project_name_delete"];

  // 데이터베이스에서 해당 프로젝트명의 데이터 삭제
  $sql = "DELETE FROM projects WHERE project_name='$project_name'";
  if ($conn->query($sql) === TRUE) {
	  echo "데이터 삭제 성공!";
	  header("Location: ./administrator.php");
	  exit;
  } else {
    echo "데이터 삭제 실패: " . $conn->error;
  }

  // 연결 종료
  $conn->close();
}
?>


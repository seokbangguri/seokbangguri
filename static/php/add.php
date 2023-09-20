<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>데이터 추가</title>
  <style>
    /* 입력 칸 스타일 */
    input[type="text"] {
      width: 300px; /* 원하는 크기로 조정 */
      height: 40px; /* 원하는 높이로 조정 */
      padding: 5px;
      font-size: 16px;
    }

    /* 버튼 스타일 */
    input[type="submit"] {
      width: 100px;
      height: 40px;
      font-size: 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>데이터 추가</h1>

  <?php
  $servername = "localhost";
  $username = "seokbangguri"; // 실제 사용자명으로 변경
  $password = "dlaoehdrodtmxj1!"; // 실제 비밀번호로 변경
  $dbname = "ph"; // 실제 데이터베이스명으로 변경

  // 데이터베이스 연결
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
  }

  if (isset($_POST['add_submit'])) {
    // 입력 받은 값들을 가져오기
    $project_name = $_POST['project_name'];
    $short_description = $_POST['short_description'];
    $detailed_description = $_POST['detailed_description'];
    $technologies = $_POST['technologies'];

    // INSERT 쿼리 실행
    $sql = "INSERT INTO projects (project_name, short_description, detailed_description, technologies) VALUES ('$project_name', '$short_description', '$detailed_description', '$technologies')";

    if ($conn->query($sql) === TRUE) {
	    echo "데이터 추가 성공!";
	    header("Location: ./administrator.php");
	    exit();
    } else {
      echo "데이터 추가 실패: " . $conn->error;
    }
  }

  // 데이터 추가 폼
  echo "<form action='./add.php' method='post'>";
  echo "<label for='project_name'>프로젝트명:</label>";
  echo "<input type='text' name='project_name' required><br>";
  echo "<label for='short_description'>요약:</label>";
  echo "<input type='text' name='short_description' required><br>";
  echo "<label for='detailed_description'>내용:</label>";
  echo "<input type='text' name='detailed_description' required><br>";
  echo "<label for='technologies'>기술:</label>";
  echo "<input type='text' name='technologies' required><br>";
  // 추가 버튼: 데이터베이스에 데이터 추가
  echo "<input type='submit' name='add_submit' value='추가'>";
  echo "</form>";

  // 연결 종료
  $conn->close();
  ?>
</body>
</html>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>데이터 수정</title>
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
  <h1>데이터 수정</h1>

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

  if (isset($_POST['update_submit'])) {
    // 프로젝트명과 수정할 값들 받아오기
    $project_name = $_POST['project_name_update'];
    $short_description = $_POST['short_description'];
    $detailed_description = $_POST['detailed_description'];
    $technologies = $_POST['technologies'];

    // UPDATE 쿼리 실행
    $sql = "UPDATE projects SET short_description='$short_description', detailed_description='$detailed_description', technologies='$technologies' WHERE project_name='$project_name'";

    if ($conn->query($sql) === TRUE) {
	    echo "데이터 수정 성공!";
	    header("Location: ./administrator.php");
	    exit();
    } else {
      echo "데이터 수정 실패: " . $conn->error;
    }
  }

  // 프로젝트명을 선택하는 폼
  echo "<form action='./update.php' method='post'>";
  echo "<label for='project_name_update'>프로젝트명:</label>";
  echo "<select name='project_name_update' id='project_name_update' required>";
  // 데이터베이스에서 프로젝트명 조회
  $sql = "SELECT project_name FROM projects";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $project_name = $row['project_name'];
    echo "<option value='$project_name'>$project_name</option>";
  }
  echo "</select><br>";

  // 수정할 값을 입력받는 폼
  echo "<label for='short_description'>요약:</label>";
  echo "<input type='text' name='short_description' required><br>";
  echo "<label for='detailed_description'>내용:</label>";
  echo "<input type='text' name='detailed_description' required><br>";
  echo "<label for='technologies'>기술:</label>";
  echo "<input type='text' name='technologies' required><br>";

  // 수정 버튼: 데이터베이스의 데이터 수정
  echo "<input type='submit' name='update_submit' value='수정'>";
  echo "</form>";

  // 연결 종료
  $conn->close();
  ?>
</body>
</html>

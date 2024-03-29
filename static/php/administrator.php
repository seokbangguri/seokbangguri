<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>데이터베이스 관리</title>
</head>
<body>
  <h1>파일 및 데이터베이스 관리 페이지</h1>

  <!-- 파일 업로드 폼 -->
  <h2>파일 업로드</h2>
  <form action="./upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="업로드" name="submit">
  </form>

  <!-- 파일 리스트 -->
  <h2>파일 리스트</h2>
  <?php
  // 파일 목록을 가져오기 위한 PHP 코드
  $files = scandir('/var/www/html/p');
  foreach ($files as $file) {
    if ($file != "." && $file != "..") {
      echo "<p><a href='/p/$file'>$file</a></p>";
    }
  }
  ?>

  <!-- 데이터베이스 연결 및 조회 -->
  <?php
  $servername = "localhost";
  $username = "seokbangguri"; // 실제 사용자명으로 변경
  $password = "fakepassword"; // 실제 비밀번호로 변경
  $dbname = "fakedatabase"; // 실제 데이터베이스명으로 변경

  // 데이터베이스 연결
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
  }

  // 데이터베이스에서 데이터 조회
  $sql = "SELECT * FROM projects"; // 실제 테이블명으로 변경
  $result = $conn->query($sql);

  // 조회 결과 출력
  if ($result->num_rows > 0) {
    echo "<h2>데이터베이스 조회 결과</h2>";
    echo "<table><thead><tr><th>프로젝트명</th><th>요약</th><th>내용</th><th>기술</th><th>동작</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['project_name'] . "</td>";
      echo "<td>" . $row['short_description'] . "</td>";
      echo "<td>" . $row['detailed_description'] . "</td>";
      echo "<td>" . $row['technologies'] . "</td>";
      echo "<td>";
      echo "<form action='./delete.php' method='post'>";
      echo "<input type='hidden' name='project_name_delete' value='" . $row['project_name'] . "'>";
      echo "<input type='submit' name='delete' value='삭제'>";
      echo "</form>";
      echo "<form action='./update.php' method='post'>";
      echo "<input type='hidden' name='project_name_update' value='" . $row['project_name'] . "'>";
      echo "<input type='submit' name='update' value='수정'>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</tbody></table>";
  } else {
    echo "데이터 없음.";
  }

  <!-- 삭제 폼: 프로젝트명을 선택한 칼럼으로 삭제 -->
  <form action="./delete.php" method="post">
    <label for="project_name_delete">프로젝트명:</label>
    <select name="project_name_delete" id="project_name_delete" required>
      <?php
      // 데이터베이스에서 프로젝트명 조회
      $sql = "SELECT project_name FROM projects";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['project_name'] . "'>" . $row['project_name'] . "</option>";
      }
      ?>
    </select>
    <!-- 삭제 버튼: 데이터베이스의 데이터 삭제 -->
    <input type="submit" name="delete" value="삭제">
  </form>

  <!-- 수정 폼: 프로젝트명을 선택한 칼럼으로 수정 -->
  <form action="./update.php" method="post">
    <label for="project_name_update">프로젝트명:</label>
    <select name="project_name_update" id="project_name_update" required>
      <?php
      // 데이터베이스에서 프로젝트명 조회
      $sql = "SELECT project_name FROM projects";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['project_name'] . "'>" . $row['project_name'] . "</option>";
      }
      ?>
    </select>
    <!-- 수정 버튼: 데이터베이스의 데이터 수정 -->
    <input type="submit" name="update" value="수정">
  </form>
 

  // 연결 종료
  $conn->close();
  ?>
</body>
<style>
  table {
    border: 1px solid black;
  }
  td, th {
    border: 1px solid black;
  }
</style>
</html>

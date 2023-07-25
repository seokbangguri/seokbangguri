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
    echo "<table><thead><tr><th>프로젝트명</th><th>요약</th><th>내용</th><th>기술</th></tr></thead><tb    ody>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row['project_name'] . "</td><td>" . $row['short_description'] . "</td><td>" .$row['    detailed_description'] . "</td><td>" . $row['technologies'] . "</td></tr>"; // 실제 열(column) 이름으로 변경
    }
    echo "</tbody></table>";
  } else {
    echo "데이터 없음.";
  }
 

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

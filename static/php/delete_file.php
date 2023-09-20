<?php
if (isset($_GET['filename'])) {
  $filename = $_GET['filename'];
  $filepath = '/var/www/html/p/' . $filename;

  // 파일 삭제
  if (unlink($filepath)) {
	  echo "파일 삭제 성공!";
	  header("Location: ./administrator.php");
	  exit();
  } else {
    echo "파일 삭제 실패.";
  }
}
?>


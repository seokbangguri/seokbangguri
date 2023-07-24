<?php
$targetDir = "/var/www/html/p/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

// 파일 업로드
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
  echo "파일 업로드 성공!";
} else {
  echo "파일 업로드 실패.";
}
?>

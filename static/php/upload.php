<?php
$targetDir = "/var/www/html/p/";
$targetFile = $targetDir . mb_convert_encoding($_FILES["fileToUpload"]["name"], "UTF-8", "auto");


// 파일 업로드
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
  echo "파일 업로드 성공!";
} else {
  echo "파일 업로드 실패.";
}
?>

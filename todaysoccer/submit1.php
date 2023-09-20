<?php

  $host = 'localhost';
  $user = 'seokbangguri';
  $pw = 'dlaoehdrodtmxj1!';
  $dbName = 'test';
  $mysqli = new mysqli($host, $user, $pw, $dbName);

  $name = $_POST['name'];
  $name = addslashes($name);
  $email = $_POST['email'];
  $email = addslashes($email);
  $password = $_POST['password'];
  $password = addslashes($password);
  $gender = $_POST['gender'];
  $gender = addslashes($gender);
    

  $sql = "insert into ex3 (
      name,
      email,
      password,
      gender
  )";
  
  $sql = $sql. "values (
      '$name',
      '$email',
      '$password',
      '$gender'
  )";

  if($mysqli->query($sql)){ 
    echo ''; 
  }else{ 
    echo '';
  }

  mysqli_close($mysqli);
  
?>

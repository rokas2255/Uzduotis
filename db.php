<?php

$conn = mysqli_connect("localhost","root","","uzduotis1");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
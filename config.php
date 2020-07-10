

<?php


// bağlantı için db değişkenleri



header('Content-Type: text/html; charset=utf-8');
  
$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "soru_makinesi"; 
$base_url = "http://localhost/";
 
$conn=mysqli_connect($servername, $username, $password, $dbname);
$conn -> set_charset("utf8");
mysqli_error($conn);






?>





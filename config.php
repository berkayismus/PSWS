<?php

// bağlantı için db değişkenleri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soru_makinesi";
$base_url = "http://localhost/";

// Bağlantı kurmak
$conn = new mysqli($servername, $username, $password,$dbname);
$conn->set_charset("utf8");


?>

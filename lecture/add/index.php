<?php

//DERS EKLEME WEB SERVİSİ
include "../../models/lecture.php";
include "../../models/message.php";
include "../../config.php";
include "../validator.php";

$lecture_name = input_validator($_GET["lecture_name"]);
$lecture_code = input_validator($_GET["lecture_code"]);

$sql = "insert into lectures (lecture_name,lecture_code) values ('$lecture_name','$lecture_code')";

$message = new Message();
if ($conn->query($sql) === TRUE) {
    $message->message = "Ders başarıyla eklendi";
    $message->tf = true;
    echo json_encode($message);
  } else {
    $message->message = "Hata : " .$sql . "<br>" . $conn->error;
    $message->tf = false;
    echo json_encode($message);
  }

// bağlantıyı kapatalım
$conn->close();

?>
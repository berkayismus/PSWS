<?php

include "../../config.php";
include "../../models/message.php";
include "../../models/lecture.php";
include "../validator.php";

// DERS GÜNCELLEYEN WEB SERVİS

// lecture_id boş gelmezse , lecture_name'i güncelleyelim
$message = new Message();
if(!empty($_POST["lecture_id"]) && !empty($_POST["lecture_name"]) && !empty($_POST["lecture_code"])){
    $lecture_id = input_validator($_POST["lecture_id"]);
    $lecture_name = input_validator($_POST["lecture_name"]);
    $lecture_code = input_validator($_POST["lecture_code"]);
    $sql = "UPDATE lectures SET lecture_name='$lecture_name', lecture_code='$lecture_code' WHERE lecture_id=$lecture_id";
    // SQL kodu başarılı bir şekilde çalışırsa
    if($conn->query($sql)===TRUE){
        $message->message = "İlgili ders başarıyla güncellendi";
        $message->tf = true;
        echo json_encode($message);
    } else{
        echo "Ders güncellenirken hata meydana geldi " . $conn->error;
    }
}

// lecture_id boş gelirse
else{
    $message->message = "lecture_id veya alanlardan en az biri boş geldi";
    $message->tf = false;
    echo json_encode($message);
}

// bağlantıyı kapatalım
$conn->close();

?>
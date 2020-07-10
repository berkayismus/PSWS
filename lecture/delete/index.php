<?php

// DERS SİLEN WEB SERVİS

include "../../models/lecture.php";
include "../validator.php";
include "../../config.php";
include "../../models/message.php";

$message = new Message();

if(!empty($_GET["lecture_id"])){
    $lecture_id = input_validator($_GET["lecture_id"]);
    $sql = "delete from lectures where lecture_id=$lecture_id";
    if($conn->query($sql) === TRUE){
        $message->message = "Ders başarıyla silindi";
        $message->tf = true;
        echo json_encode($message);
    }
    else{
        $message = new Message();
        $message->message = "SQL kodu çalışırken hata " . $conn->error;
        $message->tf = false;
        echo json_encode($message);
    }
} 
// lecture id boş gelirse
else{
    $message = new Message();
    $message->message = "lecture_id boş geldi";
    $message->tf = false;
    echo json_encode($message);
}   

$conn->close();

?>
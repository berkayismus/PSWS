<?php

// TÜM DERSLERİ LİSTELEYEN WEB SERVİS

include "../../config.php";
include "../../models/lecture.php";
include "../../models/message.php";

$sql = "select * from lectures";
$result = $conn->query($sql);

$lectures = array();
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $lecture_id = $row["lecture_id"];
        $lecture_name = $row["lecture_name"];
        $lecture_code = $row["lecture_code"];
        $lecture = new Lecture($lecture_id,$lecture_name,$lecture_code);
        $lectures[] = $lecture;
    }
    echo json_encode($lectures);        
} else {
    // veri yoksa mesaj gösterelim
    $message = new Message();
    $message->message = "Herhangi bir ders bulunamadı";
    $message->tf = false;
    echo json_encode($message);        
}


?>
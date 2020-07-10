<?php

include "../models/lecture.php";
// gelen GET veya POST'ları uygun hale getirmek için kullanılan fonk.lar
include "validator.php";
// veritabanı bağlantısı için
include "../config.php";
include "../models/message.php";


// GET ile gelen lecture_id boş değilse
if(!empty($_GET["lecture_id"])){
    $lecture_id = input_validator($_GET["lecture_id"]);
    $sql = "select * from lectures where lecture_id=$lecture_id";
    $result = $conn->query($sql);
    // sorgu sonucu dönen veri varsa 
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
           // echo "lecture id: " . $row["lecture_id"]. " - lecture name: " . $row["lecture_name"]. " " . $row["lecture_code"]. "<br>";
            $newLecture = new Lecture($row["lecture_id"],$row["lecture_name"],$row["lecture_code"]);
            // constructor'la yapılamayan durumlarda setter ile atanabilir
            echo json_encode($newLecture);
            
            
        }
    } else {
        echo "sonuç yok";
    }

} else{
    $message = new Message();
    $message->message = "lecture_id boş geldi";
    $message->tf = false;
    echo json_encode($message);
}

$conn->close();


?>
<?php

include "../../config.php";
include "../../models/message.php";
include "../validator.php";

$message = new Message();

if(!empty($_GET["question_id"])){
    $question_id = input_validator($_GET["question_id"]);
    $sql = "DELETE FROM questions WHERE question_id='$question_id'";
    if($conn->query($sql) === TRUE){
        $message->message = "Soru başarıyla silindi";
        $message->tf = true;
        echo json_encode($message);
    } else{
        $message->message = "Soruyu silerken hata: " . "<br>" . $conn->error;
        $message->tf = false;
        echo json_encode($message);
    }
} else{
    $message->message = "question_id boş geldi";
    $message->tf = false;
    echo json_encode($message);
}

$conn->close();


?>


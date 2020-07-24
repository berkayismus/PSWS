<?php

include "../../config.php";
include "../validator.php";
include "../../models/message.php";

$message = new Message();
//
$lecture_id = input_validator($_POST["lecture_id"]);
$question_id = input_validator($_POST["question_id"]);
$question_question = input_validator($_POST["question_question"]);
$question_answers = input_validator($_POST["question_answers"]);
$question_validate_answer = input_validator($_POST["question_validate_answer"]);

$sql = "UPDATE questions
SET question_question = '$question_question', question_answers = '$question_answers' , question_validate_answer = '$question_validate_answer'
WHERE lecture_id = '$lecture_id' and question_id = '$question_id'";
if($conn->query($sql) === TRUE){
    $message->message = "Soru başarıyla güncellendi";
    $message->tf = true;
    echo json_encode($message);
} else{
    $message->message = "Kayıtlar güncellenirken hata: " . $conn->error;
    $message->tf = false;
    echo json_encode($message);
}

$conn->close();



?>
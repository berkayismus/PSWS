<?php

include "../../config.php";
include "../validator.php";
include "../../models/message.php";

$message = new Message();
// question_id parametresi boş gelmezse
if(!empty($_GET["question_id"])){
    $question_id = input_validator($_GET["question_id"]);
    $question_question = input_validator($_GET["question_question"]);
    $question_answers = input_validator($_GET["question_answers"]);
    $question_validate_answer = input_validator($_GET["question_validate_answer"]);
    // lecture_id değeri bağlantılı değer olduğu için güncellenemeyecek
    $sql = "update questions set question_question='$question_question' , question_answers='$question_answers' , question_validate_answer='$question_validate_answer' where question_id=$question_id";
    // sql kodu başarılı bir şekilde çalışırsa
    if($conn->query($sql) === TRUE){
        $message->message = "Soru başarılı bir şekilde güncellendi";
        $message->tf = true;
        echo json_encode($message);
    } 
    // SQL kodu çalışırken hata alınırsa
    else{
        $message->message = "Soru güncellenirken hata oluştu " . $conn->error;
        $message->tf = false;
        echo json_encode($message);
    }

}
// question_id parametresi boş gelirse
else {
    $message->message = "question_id parametresi boş geldi";
    $message->tf = false;
    echo json_encode($message);
}

// bağlantıyı kapatalım
$conn->close();


?>
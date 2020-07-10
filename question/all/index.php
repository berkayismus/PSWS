<?php

// SORULARIN TAMAMINI GETİREN WEB SERVİS
// LİMİT parametresi belirtilirse istenen kadar getirecek

include "../../config.php";
include "../validator.php";
include "../../models/question.php";
include "../../models/message.php";


// GET ile gelenler boş değilse
if(!empty($_GET["lecture_id"]) && !empty($_GET["limit"])){
// GET ile gelen veriyi işleyelim
$lecture_id = input_validator($_GET["lecture_id"]);
$quantity = input_validator($_GET["limit"]);
    $sql = "select * from questions where lecture_id=$lecture_id LIMIT $quantity";
    $result = $conn->query($sql);
    
    // gelen veri varsa - birden fazla objenin olduğu örnek
    if($result->num_rows>0){
        // birden fazla obje döneceği için dizi oluşturalım
        $questions = array();
        while($row = $result->fetch_assoc()){
            //echo "gelen soru : " . $row["question_question"];
            $question_id = $row["question_id"];
            $question_question = $row["question_question"];
            $question_answers = $row["question_answers"];
            $question_validate_answer = $row["question_validate_answer"];
            $lecture_id = $row["lecture_id"];
            $question = new Question($question_id,$question_question,$question_answers,$question_validate_answer,$lecture_id);
    
    
            // oluşturulan question'ı , questions array'ine ekliyoruz
            $questions[] = $question;
    
            
        }
        // questions array'ini json formatında  yazdırıyoruz
        echo json_encode($questions);
    
    } 
} else{
    $message = new Message();
    $message->message = "lecture_id veya limit boş geldi";
    $message->tf = false;
    echo json_encode($message);
}

// bağlantıyı kapatalım
$conn->close();


?>
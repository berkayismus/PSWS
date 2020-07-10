<?php

include "../config.php";
include "../models/question.php";
include "validator.php";

/*$question_id = 1;
$question_question = "deneme soru";
$question_answers = "deneme cevap";
$question_validate_answer = "deneme validate cevap";
$lecture_id = 1; 

$question = new Question($question_id,$question_question,$question_answers,$question_validate_answer,$lecture_id);
echo json_encode($question); */

// GET ile gelen veriyi işleyelim

$question_id = input_validator($_GET["question_id"]);

$sql = "select * from questions where question_id=$question_id";
$result = $conn->query($sql);


/*Tam metinler	
question_id
question_question
question_answers
question_validate_answer
lecture_id */

// gelen veri varsa
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        //echo "question : " .$row["question_question"];
        $question_id = $row["question_id"];
        $question_question = $row["question_question"];
        $question_answers = $row["question_answers"];
        $question_validate_answer = $row["question_validate_answer"];
        $lecture_id = $row["lecture_id"];
        $question = new Question($question_id,$question_question,$question_answers,$question_validate_answer,$lecture_id);
        echo json_encode($question);

    }
}








?>
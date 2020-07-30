<?php

include "../../models/message.php";
include "../../config.php";
include "../validator.php";
include "../../models/question.php";

$message = new Message();
$lecture_id_from_get = input_validator($_GET["lecture_id"]);
$sql = "select * from questions where lecture_id='$lecture_id_from_get'";

$result = $conn->query($sql);
$questionArray = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

    $question_id = $row["question_id"];
    $question_question = $row["question_question"];
    $question_answers = $row["question_answers"];
    $question_validate_answer = $row["question_validate_answer"];
    $lecture_id = $row["lecture_id"];
    $questionObject = new Question($question_id,$question_question,$question_answers,$question_validate_answer,$lecture_id);
    $questionArray[] = $questionObject;
  }
  echo json_encode($questionArray);
} else {
  $message->message = "Soru bulunamadı";
  $message->tf = false;
  echo json_encode($message);
}
$conn->close();






?>
<?php

include "../../config.php";
include "../../models/question.php";
include "../validator.php";
include "../../models/message.php";

// SORU EKLEME İÇİN WEB SERVİS
// gelen http isteğini işleyelim

if(!empty($_POST["question_question"]) && !empty($_POST["question_answers"]) && !empty($_POST["question_validate_answer"]) && !empty($_POST["lecture_id"])){
  $question_question = input_validator($_POST["question_question"]);
  $question_answers = input_validator($_POST["question_answers"]);
  $question_validate_answer = input_validator($_POST["question_validate_answer"]);
  $lecture_id = input_validator($_POST["lecture_id"]);
  
  // veritabanına ekleme yapalım
  $sql = "INSERT INTO questions (question_question, question_answers, question_validate_answer, lecture_id)
  VALUES ('$question_question', '$question_answers', '$question_validate_answer',$lecture_id)";
  
  $message = new Message();
  if ($conn->query($sql) === TRUE) {
      //echo "Soru başarıyla eklendi";
      $message->message = "Soru başarıyla eklendi";
      $message->tf = true;
      echo json_encode($message);
    } else {
      //echo "Kayıt eklerken Hata: " . $sql . "<br>" . $conn->error;
      $message->message = "Soru eklerken hata : " . $sql . "<br>" . $conn->error;
      $message->tf = true;
      echo json_encode($message);
    }
}


  
  // bağlantıyı kapatalım
  $conn->close();

?>
<?php

//include "../models/lecture.php";

class Question{

public $question_id;
public $question_question;
public $question_answers;
public $question_validate_answer;
public $lecture_id;

// constructor
public function __construct($question_id,$question_question,$question_answers,$question_validate_answer,$lecture_id)
{
    $this->question_id = $question_id;
    $this->question_question = $question_question;
    $this->question_answers = $question_answers;
    $this->question_validate_answer = $question_validate_answer;
    $this->lecture_id = $lecture_id;
}





}


?>
<?php

class Lecture {
    public $lecture_id;
    public $lecture_name;
    public $lecture_code;

    function __construct($lecture_id,$lecture_name,$lecture_code)
    {
        $this->lecture_id = $lecture_id;
        $this->lecture_name = $lecture_name;
        $this->lecture_code = $lecture_code;
    }

  

    function getLectureId(){
        return $this->lecture_id;
    }

    function setLectureId($lecture_id){
        $this->lecture_id = $lecture_id;
    }
    

    function getLectureName(){
        return $this->lecture_name;
    }
    function getLectureCode(){
        return $this->lecture_code;
    }

    function setLectureName($name){
        $this->lecture_name = $name;
    }
    function setLectureCode($lecture_code){
        $this->lecture_code = $lecture_code;
    }


    
}


?>
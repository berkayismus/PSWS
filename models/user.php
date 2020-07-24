<?php

class User {
    public $user_id;
    public $user_name;
    public $user_lastname;
    public $user_password;
    public $user_email;
    public $user_status;
    public $user_validate_code;


    


    function getUserID(){
        return $this->user_id;
    }

    function setUserID($user_id) { 
        $this->user_id = $user_id;
    }

    function getUserName(){
        return $this->user_name;
    }

    function setUserName($user_name) { 
    $this->user_name = $user_name;
    } 

    function getUserLastname(){
        return $this->user_lastname;
    }

    function setUserLastname($user_lastname) { 
    $this->user_lastname = $user_lastname;
    }  

    function getUserPassword(){
        return $this->user_password;
    }

    function setUserPassword($user_password) { 
    $this->user_password = $user_password;
    } 

    function getUserEmail(){
        return $this->user_email;
    }

    function setUserEmail($user_email) { 
    $this->user_email = $user_email;
    }    
    
    function getUserStatus(){
        return $this->user_status;
    }
    
    function setUserStatus($user_status){
        $this->user_status = $user_status;
    } 

    function getUserValidateCode(){
        return $this->user_validate_code;
    }
    
    function setUserValidateCode($user_validate_code){
        $this->user_validate_code = $user_validate_code;
    } 
            

}



?>
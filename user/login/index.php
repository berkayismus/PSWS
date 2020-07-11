<?php

include "../../config.php";
include "../validator.php";
include "../../models/message.php";

$userMessage = new Message();

// parametreler boş gelmezse

if(!empty($_POST["user_name"]) && !empty($_POST["user_password"])){
    $user_name = input_validator($_POST["user_name"]);
    $user_password = input_validator($_POST["user_password"]);
    
    $isUserControl = mysqli_query($conn,"select * from users where user_name='$user_name' and user_password='$user_password'");
    $countRow = mysqli_num_rows($isUserControl);
    
    // kullanıcı varsa giriş yapabilirsin mesajı döndürelim
    if($countRow>0){
        $userMessage->message = "Kullanıcı girişi başarılı, hoşgeldiniz " .$user_name;
        $userMessage->tf = true;
        echo json_encode($userMessage);
    } else{
        $userMessage->message = "Girmiş olduğunuz bilgilere ait herhangi bir kullanıcı bulunamadı";
        $userMessage->tf = false;
        echo json_encode($userMessage);        
    }
}
// parametreler boş gelirse
else {
    $userMessage->message = "parametreler boş geldi";
    $userMessage->tf = false;
    echo json_encode($userMessage);
}

// bağlantıyı kapatalım
$conn->close();


?>
<?php

include "../config.php";
include "validator.php";
include "../models/user.php";
include "message.php";


// index.php -> user_id adlı GET parametresine göre KULLANICILARI DÖNDÜRÜR

// get ile gelen user_id'yi alalım
$user_id_from_get = input_validator($_GET["user_id"]);

// sonuç dönerse , işlem yapalım
$sql = "SELECT * from users where user_id=$user_id_from_get";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
        
            $user = new User();
            $user->user_id = $row["user_id"];
            $user->user_name = $row["user_name"];
            $user->user_lastname = $row["user_lastname"];
            $user->user_password = "gizli";
            $user->user_email = $row["user_email"];
            $user->user_status = $row["status"];
            echo json_encode($user);
        }
    } else{
        $message = new Message();
        $message->message = "Aramanızla eşleşen kayıt bulunamadı";
        $message->tf = "false";
        echo json_encode($message);
        
    }
} else{
    echo "HATA: Kod çalıştırılamadı $sql. " . mysqli_error($conn);
}
 
mysqli_close($conn);






?>
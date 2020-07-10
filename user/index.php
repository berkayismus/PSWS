

<?php

include "../config.php";
include "validator.php";
include "../models/user.php";
include "../models/message.php";

// TEKİL KULLANICI DÖNDÜREN WEB SERVİS
// index.php -> user_id adlı GET parametresine göre ilgili kullanıcıyı döndürür

// get ile gelen user_id'yi alalım
if(!empty($_GET["user_id"])){
    $user_id_from_get = input_validator($_GET["user_id"]);

    // sonuç dönerse , işlem yapalım
    $sql = "SELECT * from users where user_id=$user_id_from_get";
    
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            
                $user = new User();
                $user->setUserID($row["user_id"]);
                $user->setUserName($row["user_name"]);
                $user->setUserLastname($row["user_lastname"]);
                $user->setUserPassword("gizli");
                $user->setUserEmail($row["user_email"]);
                $user->setUserStatus($row["status"]);
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
} 
// user_id=boş gelirse
else{
    echo "user_id boş geldi";
}

 
mysqli_close($conn);






?>
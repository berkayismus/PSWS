<?php

include "../../config.php";
include "../validator.php";


// user'e gönderilen doğrulama kodu linki bu sayfayı çalıştıracak
if(!empty($_GET["user_email"]) && !empty($_GET["user_validate_code"])){
    $user_email = input_validator($_GET["user_email"]);
    $user_validate_code = input_validator($_GET["user_validate_code"]);
    $updateUser = mysqli_query($conn,"UPDATE users
    SET status = '1'
    WHERE user_email = '$user_email' and user_validate_code='$user_validate_code'");
    if ($updateUser){
        echo "Hesabınız başarılı şekilde doğrulandı, mobil uygulamadan giriş yapabilirsiniz";
    }
} else{
    echo "user_email veya user_validate_code boş geldi";
}









?>
<?php

include "config.php";
include "validator.php";

// user'e gönderilen doğrulama kodu linki bu sayfayı çalıştıracak
$user_email = input_validator($_GET["user_email"]);
$user_validate_code = input_validator($_GET["user_validate_code"]);

$updateUser = mysqli_query($conn,"UPDATE users
SET status = '1'
WHERE user_email = '$user_email' and user_validate_code='$user_validate_code'");

// updateUser true dönerse
if ($updateUser){
    echo "Doğrulama başarıyla gerçekleşti";
}




?>
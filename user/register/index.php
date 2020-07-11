<?php

include "../../config.php";
include "../../models/message.php";
include "../validator.php";

// KULLANICI KAYIT EDEN WEB SERVİS

$message = new Message();

// POST ile kullanıcı bilgilerini alalım

// parametreler boş gelmezse
if(!empty($_POST["user_name"]) && !empty($_POST["user_lastname"]) && !empty($_POST["user_password"]) && !empty($_POST["user_email"])){
    $user_name = input_validator($_POST["user_name"]);
    $user_lastname = input_validator($_POST["user_lastname"]);
    $user_password = input_validator($_POST["user_password"]);
    $user_email = input_validator($_POST["user_email"]);
    $user_validate_code = rand(0,10000).rand(0,10000);
    
    // kullanıcının veritabanında olup olmadığını kontrol edelim
    $sql = "select * from users where user_name='$user_name' or user_email='$user_email'";
    $isUserControl = mysqli_num_rows($conn->query($sql)); // kullanıcı veritabanında varsa 1 döndürecek
    
    // kullanıcı zaten varsa
    if($isUserControl>0){
        $message->message = "Böyle bir kullanıcı zaten var";
        $message->tf = false;
        echo json_encode($message);
    } else{
        // Kullanıcı veritabanında yoksa
        $sql = "insert into users (user_name,user_lastname,user_password,user_email,status,user_validate_code) values ('$user_name','$user_lastname','$user_password','$user_email','1','$user_validate_code')";
        $insertSuc = $conn->query($sql);
        // kayıt başarılı ise
        if($insertSuc === TRUE){
            $message->message = "Kayıt başarılı, uygulamadan hesabınıza giriş yapabilirsiniz";
            //$message->message = "Kayıt başarılı ile gerçekleşti, lütfen e-posta adresinize gelen aktivasyon linkine tıklayın";
            // sunucuya taşıyınca aktif edilecek mail gönderme fonksiyonu
            // emailSubmitToUser($user_email,$user_validate_code);
            $message->tf = true;
            echo json_encode($message);
        } else{
            // veritabanına kayıt ekleme esnasında hata ile karşılaşıldıysa
            $message->message = "Veritabanına kayıt eklerken hata : " . $conn->error;
            $message->tf = false;
            echo json_encode($message);
        }
    } 
}

// parametreler boş gelirse
else{
    $message->message = "parametreler boş geldi";
    $message->tf = false;
    echo json_encode($message);
}




function emailSubmitToUser($user_email,$user_validate_code) {
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "admin@berkayy.com";
    $to = $user_email;
    $subject = "Üyelik aktivasyonu";
    $message = "Üyeliğinizi doğrulamak için " . "<a href='/user/validate/?user_email=$user_email&user_validate_code=$user_validate_code'><b>tıklayın<b></a>";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
    echo "Email gönderildi.";
} 

// bağlantıyı kapatalım
$conn->close();


?>

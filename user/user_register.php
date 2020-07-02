<?php

include "../config.php";
include "validator.php";
// user nesnesi için user classı ekleyelim
include "message.php";

// veritabanı bağlantısı kontrolü - config.php
if($conn){
   // echo "Bağlantı başarılı";
} 

// kullanıcı bilgilerini post ile alalım
// input_validator - gelen veriyi doğru hale getirir (boşlukları siler vs.)
$user_name = input_validator($_GET["user_name"]);
$user_lastname = input_validator($_GET["user_lastname"]);
$user_password = input_validator($_GET["user_password"]);
// parolayı şifreleyelim
$user_password = password_hash($user_password, PASSWORD_DEFAULT);
$user_email = input_validator($_GET["user_email"]);
// user->aktif pasif yapabilmek için random user_validate_code üretelim - 8 haneli
$user_validate_code = rand(0,10000).rand(0,10000); 

// user var mı diye kontrol edelim
$isUserControl = mysqli_query($conn,"select * from users where user_email='$user_email' or user_name='$user_name'");
$countRow = mysqli_num_rows($isUserControl);

// json formatında mesaj döndürebilmek için message classından nesne oluşturalım
$userMessage = new Message();

// kullanıcı varsa
if($countRow>0){
    $userMessage->message = "Girmiş olduğunuz " . $user_name . " ve " . $user_email . " bilgileri zaten kayıtlıdır.Lütfen farklı bilgiler giriniz";
    $userMessage->tf = false;
    // mesaj döndürebilmek için nesneyi json formatında döndürelim
    echo(json_encode($userMessage));
}

// kullanıcı yoksa ekleme yapalım
else {
    $register_query = "insert into users (user_name,user_lastname,user_password,user_email,status,user_validate_code) 
    values ('$user_name','$user_lastname','$user_password','$user_email','1','$user_validate_code')";
    if ($conn->query($register_query) === TRUE) {
    // Kayıtlar başarıyla oluştuysa mesaj döndürelim (json nesnesi)
    $userMessage->message = "Hesabınız oluşturuldu, lütfen email adresinize gelen doğrulama linkine tıklayın";
    $userMessage->tf = true;
    echo json_encode($userMessage);
   
    // user'e mail atan fonksiyon - sunucuda mail() fonksiyonu aktif olmalı
    emailSubmitToUser();
    
    } else {
  echo "Hata: " . $register_query . "<br>" . $conn->error;
    }
    $conn->close();
}


function emailSubmitToUser() {
    // $base_url - config.php'den geliyor
    $user_validator_link = $base_url . "user_validator_email.php?=user_validate_code=" . $user_validate_code . "&user_email=" .$user_email;
    $subject = "Kayıt doğrulama linki";
    $text = "Merhaba " . $user_name . "<br>" 
    . "Sisteme kayıt olabilmeniz için doğruluma linkine " . "<a href='".$user_validator_link."'>tıklayın</a>";
    $from = "From: berkaydiyebiri@isbulberkay.com";
    $from .= "MIME-Version: 1.0\r\n";
    $from .= "Content-Type: text/html; charset=UTF-8\r\n";
    $isEmailSend = mail($to,$subject,$text,$from);
    /* if($isEmailSend){
        echo "<br>" . "Eposta başarı ile gönderildi";
     } */
}


?>
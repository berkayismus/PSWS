<html>
<head><title>Soru Seçme Uygulaması Web Servis</title></head>
<body>
</body>
</html>

<?php

include "user/validator.php";
include "config.php";

if(!empty($_GET["user_name"])){
    $user_name = input_validator($_GET["user_name"]);
    echo "Hoşgeldiniz " . $user_name . " burası index sayfası";
} else{
    echo "Hoşgeldiniz isminiz boş geldi";
}


?>


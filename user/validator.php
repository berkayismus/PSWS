<?php

function input_validator($data) {

 // girdideki boşlukları silmek
  $data = trim($data);
  // bilmiyorum :D
  $data = stripslashes($data);
  // get veya post ile gönderilen html karakterlerini pasif etmek - saldırıları engellemek için
  //$data = htmlspecialchars($data);
    return $data;
  
}


?>
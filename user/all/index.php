<?php
include "../../models/user.php";
include "../message.php";
include "../../config.php";
include "../validator.php";

$sql = "select * from users";
$result = $conn->query($sql);
$users = array();
$message = new Message();
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $user = new User();
        $user->user_id = $row["user_id"];
        $user->user_name = $row["user_name"];
        $user->user_lastname = $row["user_lastname"];
        $user->user_password = $row["user_password"];
        $user->user_email = $row["user_email"];
        $user->user_status = $row["status"];
        $user->user_validate_code = $row["user_validate_code"];
        $users[] = $user;
    }
    echo json_encode($users);
} else{
    $message->message = "Herhangi bir kayıt bulunamadı";
    $message->tf = false;
    echo json_encode($message);
}

$conn->close();

?>
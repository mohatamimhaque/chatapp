<?php
session_start();
include("../includes/config.php");
if(isset($_POST["user_id"])){
    $user_id= $_POST["user_id"];
    $str= $_POST["str"];
    $query = mysqli_query($con, "SELECT * FROM user WHERE id = '$user_id'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

     if($str == $row['activation_code']){
        $query = mysqli_query($con, "UPDATE user SET status = 0,activation_code='0' WHERE id = '$user_id'");
        echo 'Success';
    }
     else{
        echo "Code doesn't Matched";
     }
}
    else{
     echo 'failed';
}



}
if(isset($_POST["update"])){
    $user_id= $_POST["id"];
    $receiver = $_POST["email"];
    $activation_code = rand(100000,999999);
    $query = mysqli_query($con, "UPDATE user SET activation_code = '$activation_code' WHERE id = '$user_id'");
    if($query){
        $url = "https://script.google.com/macros/s/AKfycbzP6Rr8dxWt7COo26eh74gLtolaK1kvqq05HRkg66ZOtAPwdA3_5fQcaCZ568YUMzZZng/exec";
        $ch = curl_init($url);
        curl_setopt_array($ch, [
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_POSTFIELDS => http_build_query([
              "recipient" => $receiver,
              "subject"   => 'Activation Code',
              "body"      => 'Continue signing up for Chatapp by entering the code below:'.$activation_code
           ])
        ]);
        $result = curl_exec($ch);
        echo 'Code was Sent!!';


    }
}


?>

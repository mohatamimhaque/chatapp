<?php
session_start();
include("../includes/config.php");

$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($email) && !empty($password)){
    $query = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $_SESSION['chat'] = true;
        $_SESSION['chat_user'] = [
            'unique_id' => $row['unique_id']
        ];

      echo 'success';


    }
    else{
        echo 'Email or Password is incorrect!!';
    }

}

else{
    echo 'All Input field are required!!';
}
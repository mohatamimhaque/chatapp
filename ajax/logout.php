<?php
session_start();
include("../includes/config.php");

if(isset($_POST['logout_btn'])){
    $unique_id = $_SESSION['chat_user']['unique_id'];
    
    //session destroy()
    unset( $_SESSION['chat']);
    unset( $_SESSION['chat_user']);
}


?>

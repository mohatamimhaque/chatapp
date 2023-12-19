<?php
date_default_timezone_set('Asia/Dhaka');

$connect = new PDO("mysql:host=localhost;dbname=chatapp", "root", "");

$host = "localhost";
$username = "root";
$password = "";
$database = "chatapp";
$con =mysqli_connect("$host","$username","$password","$database",);




function base_url($slug){
    echo 'http://localhost/chatapp/'.$slug;
  }
  $url = 'http://localhost/chatapp/';
?>

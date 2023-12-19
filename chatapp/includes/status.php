<?php
 if(isset($_SESSION['chat_user'])){
    $unique_id=$_SESSION['chat_user']['unique_id'];
    $time = time();
    mysqli_query($con, "UPDATE user SET logged_time = ' $time' WHERE unique_id = '$unique_id'");
}

?>
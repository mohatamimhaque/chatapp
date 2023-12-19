<?php
session_start();
include("../includes/config.php");
function unique_id($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
while(TRUE){
    $unique_id = unique_id();
    $id =  mysqli_query($con, "SELECT unique_id from user WHERE unique_id='$unique_id'");
    if(mysqli_num_rows($id)>0){
        continue;
    }
    else{
        break;
    }
}

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = 1 ;
   if(!empty($first_name) && !empty( $last_name) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $checkmail = mysqli_query($con, "SELECT email FROM user WHERE email = '$email'");
            if(mysqli_num_rows($checkmail) > 0){
                echo $email.' - this email already exist!!!';
            }
            else{
                if(!empty($_FILES['photo'])){
                   $filename = $_FILES['photo']['name'];
                   if($filename != ''){
                    $image_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    $image_name = $unique_id.'.'.$image_extension;

                    $ext = ['jpg','jpeg','png','jfif'];
                    if(in_array( $image_extension,$ext)){
                            $query = "INSERT INTO user SET unique_id='$unique_id',first_name='$first_name',last_name='$last_name',email='$email',password='$password',photo='$image_name',status='$status'";
                            $query_run = mysqli_query($con, $query);
                            if($query_run){
                                move_uploaded_file($_FILES['photo']['tmp_name'], '../upload/image/'.$image_name);
                            
                                $_SESSION['chat'] = true;
                                $_SESSION['chat_user'] = [
                                    'unique_id' => $unique_id
                                ];


                            $user_id= $unique_id;
                            $receiver = $email;
                            $activation_code = rand(100000,999999);
                            $query = mysqli_query($con, "UPDATE user SET activation_code = '$activation_code' WHERE unique_id = '$user_id'");
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
                               
                               
                                echo 'success';
            
                            }
                            else{
                                echo 'something went worng!!';
                            }
                    }
                    else{
                        echo 'please select an image file -jpg, jpg, png, jfif!!';
                    }

                       
                   }
                   else{
                    echo 'Please Select an Image For profile photo!!';
                }
                }
                else{
                    echo 'Please Select an Image For profile photo!!';
                }
            }
        }}
        else{
            echo $email.' - this is no a valid email!!';
        }
   }
   else{
    echo 'All Input field are required!!';
   }



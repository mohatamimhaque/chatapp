<?php
session_start();
include("../includes/config.php");
    $unique_id = $_SESSION['chat_user']['unique_id'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $update_filename='';
    if($image != NULL){
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = $unique_id.'.'.$image_extension;
        $update_photo=$filename;
    }
    else{
        $update_photo=$old_image;
        $image_extension = explode(".", $update_photo)[1];
    }
   if(!empty($first_name) && !empty( $last_name) && !empty($email) && !empty($password)){
        $ext = ['jpg','jpeg','png','jfif'];
        if(in_array( $image_extension,$ext)){
            $query = "UPDATE user SET first_name='$first_name',last_name='$last_name',email='$email',password='$password',photo='$update_photo'  WHERE unique_id='$unique_id'";     
            $query_run = mysqli_query($con, $query);
            if($query_run){
                if($image!=NULL){
                    if(file_exists('../upload/image/'.$old_image)){
                         unlink('../upload/image/'.$old_image);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'], '../upload/image/'.$update_photo);
                }
                echo 'success';
            }
            else{
                echo 'Something went worng!!';
            }
        }
        else{
            echo 'please select an image file -jpg, jpg, png, jfif!!';

        }

   }
   else{
    echo 'All Input field are required!!';
   }



<?php
session_start();
include("../includes/config.php");
if(isset($_SESSION['chat_user'])){  
  $message = $_POST['message'];
  $outgoing_id = $_POST['sender'];
  $incoming_id = $_POST['receiver'];

  if(isset($_FILES['image'])){  
    $img=array();
    $x=1;
    foreach ($_FILES['image']['tmp_name'] as $key => $image) {
      $imageTmpName = $_FILES['image']['tmp_name'][$key];
      $imageName = $_FILES['image']['name'][$key];
      $ext=pathinfo($imageName,PATHINFO_EXTENSION);
      $filename = date('YmdHis').$x.'.'.$ext;
      $x++;
      move_uploaded_file($imageTmpName,'../upload/message/image/'.$imageName);
      $img[] = $imageName;	
        }	
        $image = implode(",", $img);
      }
    
  
  else{
    $image = '';
  }
  if(isset($_FILES['file'])){  
    $files=array();
    $x=1;
    foreach ($_FILES['file']['tmp_name'] as $key => $file) {
      $imageTmpName = $_FILES['file']['tmp_name'][$key];
      $imageName = $_FILES['file']['name'][$key];
      $ext=pathinfo($imageName,PATHINFO_EXTENSION);
      $filename = date('YmdHis').$x.'.'.$ext;
      $x++;
      move_uploaded_file($imageTmpName,'../upload/message/file/'.$imageName);
      $files[] = $imageName;	
        }	
        $file = implode(",", $files);
      }
    
  
  else{
    $file = '';
  }
  $created_at = date('Y-m-d H:i:s');
    $query = "INSERT INTO message SET outgoing_id='$outgoing_id',incoming_id='$incoming_id',message='$message',image='$image',file='$file',created_at='$created_at'";
    $query_run = mysqli_query($con, $query) or die();
    if($query_run){
  
      
    }

    


  }
  else{
    header("location:".$url);
    exit(0);
  }


  ?>
<?php
session_start();
include("../includes/config.php");
?>

<?php
if(isset($_SESSION['chat_user'])){
$unique_id = $_SESSION['chat_user']['unique_id'];
  $outgoing_id = $_POST['sender'];
  $incoming_id = $_POST['receiver'];
  $query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$incoming_id' and status =0");
  if(mysqli_num_rows($query) > 0){
      $row = mysqli_fetch_assoc($query);
      $loggedtime = time() - 300;
      
      $query = mysqli_query($con, "SELECT * FROM message WHERE outgoing_id='$unique_id' AND incoming_id = '$incoming_id'");
      if(mysqli_num_rows($query) > 0){
        if($row['status'] != 0){
            if($row['logged_time'] > $loggedtime) {
                    mysqli_query($con, "UPDATE message SET status = 2  WHERE outgoing_id='$unique_id' AND incoming_id = '$incoming_id'");     
                }
            }
        }
    }
  
  $query = "SELECT * FROM message WHERE outgoing_id = '$outgoing_id' AND incoming_id = '$incoming_id'
            OR outgoing_id = '$incoming_id' AND incoming_id = '$outgoing_id' ORDER BY id DESC";
  $query_run = mysqli_query($con, $query);
  if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $row){
        $d1 = date('Y-m-d H:i:s');
$d2 = date('Y-m-d H:i:s',strtotime($row['created_at']));
$date1 = new DateTime($d2);
$date2 = new DateTime($d1);
$interval = $date1->diff($date2);
$diff = $interval->d;
if($diff < 7){
    if($diff < 1){
        $t = date('g:i A',strtotime($row['created_at']));
    }
    else{
        $t = date('l g:i A',strtotime($row['created_at']));
    }
}
else{
    $t = date('M d, Y, g:i A',strtotime($row['created_at']));
}
        if($row['outgoing_id'] ==  $outgoing_id){
           $in_id = $row['outgoing_id'];
           $q =  mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$in_id'");
           if(mysqli_num_rows($q) > 0){
               foreach($q as $r){
               }}
?>
 <div class="chat outgoing" style='flex-direction:column'>
    <small translate='no' style='text-align:center;font-size:11px;color:rgba(0,0,0,0.60);margin-bottom:2px'>
    <?= $t ?>

</small>
     <div class="details" style='display:flex;flex-direction:column;align-items:end'>
     <?php
          if($row['file'] != ''){
            ?>
       <div class="file_show">
           <?php
           $file = (explode(',',$row['file']));
           foreach($file as $f){
               $c = (explode('.',$f));
               $result = $c[0];
               (strlen($result) > 20) ? $msg = substr($result, 0, 20).'..': $msg = $result;
               ?>
           <div class="item">
               <a href="<?= base_url('upload/message/file/'.$f) ?>" download><?= $msg.'.'.$c[1] ?></a>
           </div>
           <?php } ?>
       </div>
       <?php
   }
     if($row['image'] != ''){
    
    ?>
     <div class="img_show mb-1">
        <?php
         $image = (explode(',',$row['image']));
         foreach($image as $i){
           
        ?>
            <a class="item" href="<?= base_url('upload/message/image/'.$i) ?>" target='_blank'>
                <img src="<?= base_url('upload/message/image/'.$i) ?>" alt="">
            </a>
          
            <?php 
        }
        echo '</div>';
    }
     if($row['message'] != ''){
        ?>
         <p translate='no'><?= $row['message'] ?></p>
         <?php
        }
        
             if($row['status'] == 0){
                 ?>
            <div class='status-ceckh' style='border:none'>
                <img src="<?= base_url('upload/image/'.$r['photo']) ?>" alt="" title="<?= $r['first_name'].' '.$r['last_name']?>" style="border-radius:50%;width:14px;height:14px;">
             </div>
 <?php            
             }
             else if(($row['status'] == 1)){
                 ?>
                 <div class='status-ceckh' style=''>
                     <i class="fa-solid fa-check" style='font-size:10px;color:rgba(0,0,0,0.50)'></i>
                    </div>
             <?php }
             else if(($row['status'] == 2)){
                 ?>
                 <div class='status-ceckh' style='background-color:#767677;border:none;padding:1px'>
                     <i class="fa-solid fa-check" style='font-size:10px;color:rgb(28,30,33);'></i>
                    </div>
             <?php }


//include("../includes/react.php");

             ?>
    </div>
</div>
<?php
       }
       else{
        $in_id = $row['outgoing_id'];
           $q =  mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$in_id'");
           if(mysqli_num_rows($q) > 0){
               foreach($q as $r){
                
               }}


//echo $diff->format("%R%a days");

?>




<div class="chat incoming" style="display:flex;align-items:center">
    <img style=' width:38px;height: 38px;border-radius: 50%;margin-right:4px' src="<?= base_url('upload/image/'.$r['photo']) ?>" alt="" title="<?= $r['first_name'].' '.$r['last_name']?>">
    <div class="details">
    <?php
     if($row['message'] != ''){
        echo "<p translate='no' class='m-0'>".$row['message']."</p>";
    }
     if($row['image'] != ''){
     ?>
     <div class="img_show">
        <?php
         $image = (explode(',',$row['image']));
         foreach($image as $i){
           
        ?>
            <a class="item" href="<?= base_url('upload/message/image/'.$i) ?>" target='_blank'>
                <img src="<?= base_url('upload/message/image/'.$i) ?>" alt="">
            </a>
          
            <?php 
        }
        echo '</div>';
    }
    if($row['file'] != ''){
        ?>
   <div class="file_show">
       <?php
       $file = (explode(',',$row['file']));
       foreach($file as $f){
           $c = (explode('.',$f));
           $result = $c[0];
           (strlen($result) > 20) ? $msg = substr($result, 0, 20).'..': $msg = $result;
           ?>
       <div class="item">
           <a href="<?= base_url('upload/message/file/'.$f) ?>" download><?= $msg.'.'.$c[1] ?></a>
       </div>
       <?php } ?>
   </div>
   <?php
}
    ?>
    </div>
    
</div>
<small translate='no' style='text-align:center;font-size:11px;color:rgba(0,0,0,0.60);margin-bottom:2px'>
<?= $t ?>
</small>
<?php
       }
       if($row['incoming_id'] ==  $outgoing_id){
            $id = $row['id'];
            $query = "UPDATE message SET status = 0  WHERE id='$id'";     
            $query_run = mysqli_query($con, $query);
        }

    }}
    else{
        ?>
        <p  style='text-align:center'>No Conversion Available.</p>
        <?php
    }
  }
  else{
    header("location:".$url);
    exit(0);
  }


  ?>
  <style>
    .chatbox .chat p{
  margin:0;
  padding:5px 8px;
  text-align: justify;
  font-size: 14px;
  overflow: hidden;
}
.status-ceckh{
    width:14px;height:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,0.50);border-radius:50%;margin-top:2px;
}
  </style>

<script>

$(".button").click(function(){
    $(".reactions").toggleClass("visible");
    
})
</script>
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>

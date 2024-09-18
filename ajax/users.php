<?php
session_start();
include("../includes/config.php");
$unique_id = $_SESSION['chat_user']['unique_id'];

$check = mysqli_query($con, "SELECT * FROM message WHERE outgoing_id = '$unique_id' OR incoming_id = '$unique_id' ORDER BY created_at DESC");
$friend_list = array();
if(mysqli_num_rows($check) > 0){
    foreach($check as $c){
        if (in_array($c['outgoing_id'], $friend_list, TRUE)){
        }
        else{
            $friend_list[]=$c['outgoing_id'];

        }
        if(in_array($c['incoming_id'], $friend_list, TRUE)){
        }
        else{
            $friend_list[]=$c['incoming_id'];
        }
        
        ?>
<?php
    }}
    if (($key = array_search($unique_id, $friend_list)) !== false) {
        unset($friend_list[$key]);
    }

    foreach($friend_list as $f){
$query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$f'");
if(mysqli_num_rows($query) > 0){
    foreach($query as $row){
        $unique_id = $_SESSION['chat_user']['unique_id'];
        if($row['unique_id'] != $unique_id){
        ?>

<a href="<?= base_url('message/'.$row['unique_id']) ?>" translate="no">
    <div class="content">
        <div style='position:relative;width:45px;height:45px'>
            <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="">
            <?php
                $loggedtime = time() - 300;
                if($row['logged_time'] > $loggedtime) { ?>
                <span class="online" style='z-index:10;position:absolute;bottom:4px;right:6px'></span>
                <?php
                    }
            else{
                    ?>
                <span class="offline" style='z-index:10;position:absolute;bottom:4px;right:6px'></span>
                    <?php
                }
                ?>
        </div>
        <div class="details">
            <span><?= $row['first_name'].' '.$row['last_name'] ?></span>
            <?php
            $id =  $row['unique_id'];
            $p =  mysqli_query($con, "SELECT * FROM message WHERE outgoing_id = '$id' AND incoming_id = '$unique_id' OR outgoing_id = '$unique_id' AND incoming_id = '$id'  ORDER BY id DESC LIMIT 1");

            if(mysqli_num_rows($p) > 0){
                foreach($p as $p){
                    $outgoing_id = $p['outgoing_id'];
                    $incoming_id = $p['incoming_id'];

                    if($p['status'] != 0){
                        $que = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$incoming_id' and status = 0");
                        if(mysqli_num_rows($que) > 0){
                            $ro = mysqli_fetch_assoc($que);
                            $loggedtime = time() - 300;
                              if($ro['logged_time'] > $loggedtime) { 
                                mysqli_query($con, "UPDATE message SET status = 2  WHERE outgoing_id = '$outgoing_id' AND incoming_id = '$incoming_id' AND status = 1");     
                              }
                        }
                    }
                        $result = $p['message'];
                    (strlen($result) > 45) ? $msg = substr($result, 0, 50).'...': $msg = $result;



                    if($p['outgoing_id'] != $unique_id AND $p['status'] != 0){
                   ?>

                <p style='font-weight:700'> <?= $msg ?> </p>
                   <?php
                }
                else{
                    ?>
                    <p> <?= $msg ?> </p>
                       <?php
                }
                }}
                else{
                    ?>
                  <p> No message available </p>

                    <?php
                }
            
            ?>
        </div>
    </div>
    <?php
    $p =  mysqli_query($con, "SELECT * FROM message WHERE outgoing_id = '$id' AND incoming_id = '$unique_id' OR outgoing_id = '$unique_id' AND incoming_id = '$id'  ORDER BY id DESC LIMIT 1");

if(mysqli_num_rows($p) > 0){
    foreach($p as $p){
        if($p['outgoing_id'] == $unique_id){
            if($p['status'] == 1){
                ?>
                <div class='status-ceckh' style=''>
                    <i class="fa-solid fa-check" style='font-size:10px;color:rgba(0,0,0,0.50)'></i>
                   </div>
            <?php }
            else if($p['status'] == 0){
?>
 <div class='status-ceckh' style='border:none'>
                <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="" title="<?= $r['first_name'].' '.$r['last_name']?>" style="border-radius:50%;width:14px;height:14px;">
             </div>
<?php
            }
            else if($p['status'] == 2){
                ?>
                <div class='status-ceckh' style='background-color:#767677;border:none;'>
                    <i class="fa-solid fa-check" style='font-size:10px;color:rgb(28, 30, 33);'></i>
                   </div>
            <?php }

    }
   
    }}
    ?>
    </a>




<style>
    .status-ceckh{
    width:14px;height:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,0.50);border-radius:50%;margin-top:2px;
}
</style>

<?php



    }}}}
?>  





















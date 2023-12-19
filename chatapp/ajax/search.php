<?php
session_start();
include("../includes/config.php");
$searchTerm = $_POST['searchTerm'];
$query = mysqli_query($con, "SELECT * FROM user WHERE status = 0 AND first_name LIKE '%".str_replace(" ", "%", $searchTerm)."%' OR status = 0 AND last_name LIKE '%".str_replace(" ", "%", $searchTerm)."%'");
if(mysqli_num_rows($query) > 0){
    foreach($query as $row){
        $unique_id = $_SESSION['chat_user']['unique_id'];
        if($row['unique_id'] != $unique_id){
        ?>
<a href="<?= base_url('message/'.$row['unique_id']) ?>">
    <div class="content">
        <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="">
        <div class="details">
            <span><?= $row['first_name'].' '.$row['last_name'] ?></span>
            <?php
            $id =  $row['unique_id'];
            $p =  mysqli_query($con, "SELECT * FROM message WHERE outgoing_id = '$id' AND incoming_id = '$unique_id' OR outgoing_id = '$unique_id' AND incoming_id = '$id'  ORDER BY id DESC LIMIT 1");

            if(mysqli_num_rows($p) > 0){
                foreach($p as $p){
                    if($p['status'] == 1){
                   ?>
                <p style='font-weight:700'> <?= $p['message'] ?> </p>
                   <?php
                }
                else{
                    ?>
                    <p> <?= $p['message'] ?> </p>
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
    $loggedtime = time() - 300;
    if($row['logged_time'] > $loggedtime) { ?>
    <span class="online"></span>
    <?php
        }
   else{
        ?>
    <span class="offline"></span>
        <?php
    }
    ?>
</a>



<?php
        }

    }}

        else{
            echo "No Data Found!!";
        }


?>





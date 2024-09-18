<?php
session_start();
include('includes/header.php');
if(!isset($_SESSION['chat_user'])){
    header("location:".$url.'signin');
   exit(0);
  }
  if(isset($_SESSION['chat_user'])){
    $id = $_SESSION['chat_user']['unique_id'];
    $query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$id' and status = 0");
    if(mysqli_num_rows($query) > 0){

    }

    else{
        header("location:".$url);
        exit(0); 
    }
  }
  if(isset($_GET['id'])){
    $unique_id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$unique_id' and status =0");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
   
?>

<div id="wrapper">
        <div class="user">
        <div class="header">
                
                <div class="content">
                <a href="<?= base_url('') ?>" class="back-icon"><i class="fa-solid fa-arrow-left-long"></i></a>
                    <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="">
                    <div class="details">
                        <a href="" translate="no"><?= $row['first_name'].' '.$row['last_name'] ?></a>
                        <p>
                        <?php
                        $loggedtime = time() - 300;
                        if($row['logged_time'] > $loggedtime) { 
                            echo "Online";
                            }
                    else{
                        echo "Offline";
                        }
                        ?>
                        </p>
                    </div>
                </div>
            </div>
           <div class="chatbox">
          <!----------- auto fill from ajax/insert-chat.php------------------>
            </div>
             
          <form action='' class="message_input">
          <input type="hidden" value= '<?= $_SESSION['chat_user']['unique_id'] ?>' id='sender' name='sender'>
            <input type="hidden" value= '<?= $unique_id ?>' id='receiver' name='receiver'>
              
            <div class="content">
                <div class="attach hidden">
                    <a class="plus">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <ul>
                        <li>
                             <input type="file"  accept="image/*" id="image" name="image[]" multiple>
                             <label for="image">
                                 <i  class="fa-solid fa-image"></i> <span>Add Photo</span>
                             </label>                  
                        </li>
                        <li>
                             <input type="file" id="file" name="file[]" accept="video/*,audio/*,.pdf,.psd,.ai,.doc,xls" multiple>
                             <label for="file">
                                 <i  class="fa-solid fa-file"></i> <span>Attach File</span>
                             </label>                  
                        </li>
                    </ul>
                </div>
                <div class="message">
                    <div class="preview">
                        <div>
                            <div class="plus">
                                <i style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v3/yE/r/tm0HYFox2e8.png&quot;); background-position: 0px -99px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>                        
                            </div>
                        </div>
                        <div class="image-preview">
                            <!----
                            <div class="item">
                                <div class="bar minus"><div></div></div>
                                <img src="assets/image//final.jpg" alt="">
                            </div>
                        -->
                        </div>

                        <div class="file-preview d-flex">
                            <!----
                            <div class="item">
                                <div class="bar minus"><div></div></div>
                                    <p>
fgfgvfgvfg ffffffffffffff fffffffffffffffff ffffgggggggggg
                                    </p>             
                            </div>
                        -->
                        </div>
                        
                    </div>
                    <input type="text" name='message' id="message" placeholder="Type a message here...">
                </div>
                <a id='send_message'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Paper Plane</title><path d="M53.12 199.94l400-151.39a8 8 0 0110.33 10.33l-151.39 400a8 8 0 01-15-.34l-67.4-166.09a16 16 0 00-10.11-10.11L53.46 215a8 8 0 01-.34-15.06zM460 52L227 285" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                </a>
            </div>
                      </div>

    </div>

<style>
    
      
</style>





<?php
  }
  else{
    header("location:".$url);
    exit(0);
  }}
  else{
    header("location:".$url);
    exit(0);
  }



?>
<script>
    $(document).ready(function(){
        setInterval(() => {
           //let's start ajax
           let xhr = new XMLHttpRequest();
           xhr.open("POST","<?= base_url('ajax/get-chat') ?>", true);
           xhr.onload = () =>{
                if(xhr.readyState === XMLHttpRequest.DONE ){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        $(".chatbox").html(data);
                    }
                }
           }

      
           const formData = new FormData();
            formData.append("sender", $('#sender').val());
            formData.append("receiver",$('#receiver').val());
            xhr.send(formData);//sending the form data to php
        },500);


    })


</script>
<script>
$(".reaction").click(function(){
    
    var dataPopupNew = $(this).attr("data-i");
   console.log(dataPopupNew);
    $(".reactions").toggleClass("visible");
    
});

$(".button").click(function(){
    $(".reactions").toggleClass("visible");
    
})
</script>
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>

                <?php
include('includes/insert-chat.php');
include('includes/footer.php');
?>
<?php
session_start();
if(!isset($_SESSION['chat_user'])){
    header("location:".$url.'signin');
   exit(0);
  }
else{
include('includes/header.php');


    $unique_id = $_SESSION['chat_user']['unique_id'];
    $query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$unique_id'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $user_id = $row['id'];
  
    ?>
   <div id="wrapper">
        <div class="user">
            <div class="header">
                <div class="content">
                    <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="">
                    <div class="details">
                        <a href="<?= base_url('profile') ?>" translate="no"><?= $row['first_name'].' '.$row['last_name'] ?></a>
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
                <button class="logout" name="logout" id="logout_btn">Logout</button>
            </div>
            <div class="body">
<?php
if($row['status'] == 0){

?>
                <form class="search">
                    <input type="text" id='searchBar' placeholder="Enter name to Search...">
                    <span></span>
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
               
                <div class="user-list" style="overflow:auto">
                  
                    <!-------------------autofill from ajax/users--------------------->
                </div>
<?php
}

else{
    ?>
    <input type="hidden" value =" <?= $user_id ?>" id=user_id >
    <input type="hidden" value =" <?= $row['email'] ?>" id=email >
  <div class="active_account">
                <div class="content">
                    <p>You're almost done!</p>
                    <p>We sent a lanuch code to <span><?= $row['email'] ?></span></p>
                    <div class="inputfield">
                        <p><i class="fa-solid fa-arrow-right-long"></i> Enter code</p>
                        <div class="code-container">
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                            <input type="number" class="code" placeholder="0" min="0" max="9" required>
                          </div>
                    </div>

                </div>
                <p>Didn't get your email? <button id="resend">Resend the code</button> or <a href="<?= base_url('profile') ?>">update your email address.</a></p>
            </div>


<?php
}
?>



            </div>
        </div>

    </div>


<?php

                    }}
?>


 <script>
    $(document).ready(function(){ 
        const user_list = document.querySelector(".user-list");
        const searchBar = document.querySelector("#searchBar");

        setInterval(() => {
           //let's start ajax
           let xhr = new XMLHttpRequest();
           xhr.open("GET","<?= base_url('ajax/users') ?>", true);
           xhr.onload = () =>{
                if(xhr.readyState === XMLHttpRequest.DONE ){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(!searchBar.classList.contains('is-active')){
                            user_list.innerHTML = data;
                        }
                    }
                }
           }

      
           xhr.send();
        },500);


    })
</script>


    <script>
    $(document).ready(function(){ 
        const user_list =  document.querySelector(".user-list");;
        const searchBar = document.querySelector("#searchBar");
        
        searchBar.onkeyup = ()=>{
            let searchTerm = searchBar.value; // let's start Ajax 
            if(searchTerm !== ''){
                searchBar.classList.add("is-active");
            }
            else{
                searchBar.classList.remove("is-active");
            }
            let xhr = new XMLHttpRequest(); //creating XML object 
            xhr.open("POST", "<?= base_url('ajax/search') ?>", true); 
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE) { 
                if(xhr.status === 200) {
                    let data = xhr.response; 
                    user_list.innerHTML = data;
                }}}
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("searchTerm=" + searchTerm)
                    }
    })
    

</script>
<script>
    
$(document).ready(function(){
   const codes = document.querySelectorAll('.code')
codes[0].focus()
codes.forEach((code, idx) => {
    code.addEventListener('keydown', (e) => {
        if(e.key >= 0 && e.key <=9) {
            codes[idx].value = ''
            setTimeout(() => codes[idx + 1].focus(), 10)
        } else if(e.key === 'Backspace') {
            setTimeout(() => codes[idx - 1].focus(), 10)
        }
    })
})

});
$(document).ready(function(){

var codes = $(".code");
var str = '';
codes[5].addEventListener("keyup", (event) => {
    str =  $(codes[0]).val() + $(codes[1]).val() + $(codes[2]).val() + $(codes[3]).val() + $(codes[4]).val() + $(codes[5]).val();      
    if(str.length === 6){
        var user_id = $('#user_id').val();
        $.ajax({
        url:" <?= base_url('ajax/account-active') ?>",
        type:"POST",
        cache:false,
        data:{user_id:user_id,str:str},
        success:function(data){
            alert(data);
             location.reload()
          }  
      });
    }
    }); 
});



</script>


<script>
    $(document).ready(function(){
        $(".active_account button").click(function(){
            var user_id = $('#user_id').val();
            var email = $('#email').val();
            $.ajax({
            url:" <?= base_url('ajax/account-active') ?>",
            type:"POST",
            cache:false,
            data:{id:user_id,update:'str',email:email},
            success:function(data){
                //alert("Code Was Sent!!");
                alert(data);
                location.reload()
          }  
      });
    

        })
   });
   
</script>


<?php
include('includes/footer.php');
?>
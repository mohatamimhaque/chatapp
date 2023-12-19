<?php
session_start();
include('includes/header.php');
if(!isset($_SESSION['chat_user'])){
    header("location:".$url);
   exit(0);
  }

    $unique_id = $_SESSION['chat_user']['unique_id'];
    $query = mysqli_query($con, "SELECT * FROM user WHERE unique_id = '$unique_id'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
    
 ?>

<div id="wrapper">
        <div class="form signup">
           
            <a href="<?= base_url('') ?>" class='back_btn'>back</a>
          
            <div class="signupform">
                <div class="form-header">
                    <h3 translate="no">ChatApp</h3>
                    <p>Profile</p>
                </div>
                <form action="">
                    <div class="error_text"><p class="m-0">This is an error message.</p></div>
                    <div class="profile-photo">
                        <a href="<?= base_url('upload/image/'.$row['photo']) ?>" class="image">
                            <img src="<?= base_url('upload/image/'.$row['photo']) ?>" alt="" id="preview_image">
                            <input type="hidden" for="" name='old_image' id="old_image" value="<?= $row['photo'] ?>">
                        </a>
                        <div class="new_photo">
                            <div class="image">
                                <input accept=".jpg,.jpeg,.png,.jfif" type="file" name='image' id="image">
                                <label for="image"><i class="fa-solid fa-camera"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="is-active ">
                            <div class="loginrow mt-4">
                                <input type="text" name='first_name' id="first_name" placeholder="First Name" class="input-shadow" style="width:49%" value="<?= $row['first_name'] ?>">
                                <input type="text" name='last_name' id="Last_name" placeholder="Last Name" class="input-shadow" style="width:49%" value="<?= $row['last_name'] ?>">
                            </div>
                            <div class="loginrow mt-2 mb-2">
                                 <input type="email" name="email" id="email" placeholder="Email" value="<?= $row['email'] ?>">
                            </div>
                           
                            <div class="loginrow mt-2 mb-2" style="display:block">
                                 <input type="password" name="password" id="password" placeholder="Password" value="<?= $row['password'] ?>">
                                 <div class="d-flex justify-content-between">
                                     <div class="form-check">
                                         <input type="checkbox" id="showpasscode" class="form-check-input">
                                         <label for="showpasscode" class="form-check-label" style="font-size:12px">Password Show</label>
                                     </div>
                                 </div>
                            </div>
                          
                     

                            <div class="loginrow login-btn mt-2">
                                <button>Update</button>
                            </div>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

<?php
    }
    else{
        header("location:".$url);
        exit(0);
    }

?>
<script>
    $(document).ready(function(){
        const form = document.querySelector("form");
        const submit = form.querySelector("button");
        const error_text_div = document.querySelector(".error_text");
        const error_text = document.querySelector(".error_text p");
        
        form.onsubmit = (e) =>{
            e.preventDefault();
        }
        submit.onclick = () =>{
           //let's start ajax
           let xhr = new XMLHttpRequest();
           xhr.open("POST","<?= base_url('ajax/profile_update') ?>", true);
           xhr.onload = () =>{
                if(xhr.readyState === XMLHttpRequest.DONE ){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(data == 'success'){
                            //alert(data);
                            location.reload();
                        }
                        else{
                            error_text.textContent = data;
                            error_text_div.style.display = 'block';
                        }
                    }
                }
           }

           //we have to send the form data through ajax to php
           //et fd = new formData(form);//creating new formdata object
           const fd = new FormData(form);

           xhr.send(fd);//sending the form data to php
           
        }

    })
</script>

<script>
    $(document).ready(function(){
    $('.new_photo input[type="file"]').change(function(e){
        var preview = document.querySelector('#preview_image');
        var file    = document.querySelector('.new_photo input[type=file]').files[0];
        var reader  = new FileReader();
      
        reader.onloadend = function () {
          preview.src = reader.result;
        }
      
        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
        }
    });
    });

</script>
<?php
include('includes/footer.php');
?>
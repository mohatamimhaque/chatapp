<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['chat_user'])){
    header("location:".$url);
   exit(0);
  }
?>

<div id="wrapper">
        <div class="form signup">
            <div class="signupform">
                <div class="form-header">
                <h3 translate='no'>ChatApp</h3>
                    <p>SIGN UP</p>
                </div>
                <form action=""  enctype="multipart/form-data">
                    <div class="error_text"><p class="m-0"></p></div>
                    <div class="is-active ">
                            <div class="loginrow mt-4">
                                <input type="text" name='first_name' id="first_name" placeholder="First Name" class="input-shadow" style="width:49%" ddddddddd>
                                <input type="text" name='last_name' id="Last_name" placeholder="Last Name" class="input-shadow" style="width:49%" ddddddddd>
                            </div>
                            <div class="loginrow mt-2 mb-2" style="display:block">
                                 <input type="password" name="password" id="password" placeholder="Password" ddddddddd>
                                 <div class="d-flex justify-content-between">
                                     <div class="form-check">
                                         <input type="checkbox" id="showpasscode" class="form-check-input" >
                                         <label for="showpasscode" class="form-check-label" style="font-size:12px">Password Show</label>
                                     </div>
                                 </div>
                            </div>
                            <div class="loginrow mt-2 mb-2">
                                 <input type="email" name="email" id="email" placeholder="Email" ddddddddd>
                            </div>
                           
                            <div class="loginrow profile-photo">
                                <div class="custom_file position-relative" style="overflow:hidden">
                                    <input type="file" accept=".jpg,.jpeg,.png,.jfif" name='photo' id="photo" ddddddddd>
                                    <label for="photo" class="show_filename" style="">Profile Photo...</label>
                                </div>
                            </div>

                            <div class="loginrow login-btn mt-2">
                                <button type="submit" name="signup">Signup</button>
                            </div>
                            <div class="form-footer mt-2">
                                <p class="fs-14 m-0">or</p>
                                <a class="fs-17" href="<?= base_url('signin') ?>">Have an account? Login here...</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>

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
           xhr.open("POST","<?= base_url('ajax/signup') ?>", true);
           xhr.onload = () =>{
                if(xhr.readyState === XMLHttpRequest.DONE ){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(data == 'success'){
                            location.href = '<?= base_url('') ?>';
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
<?php
include('includes/footer.php');
?>
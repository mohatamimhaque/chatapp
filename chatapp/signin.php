<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['chat_user'])){
    header("location:".$url);
   exit(0);
  }
?>

<div id="wrapper">
        <div class="form login">
            <div class="loginform">
                <div class="form-header">
                    <h3 translate='no'>ChatApp</h3>
                    <p>SIGN IN</p>
                </div>
                <form action="">
                    <div class="error_text"><p class="m-0">This is an error message.</p></div>
                    <div style="" class="is-active ">
                            <div class="loginrow mt-4">
                                <input type="email" name='email' id="email" placeholder="Email" class="input-shadow">
                            </div>
                            <div class="loginrow mt-2 mb-2">
                                 <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" id="showpasscode" class="form-check-input">
                                    <label for="showpasscode" class="form-check-label" style="font-size:12px">Password Show</label>
                                </div>
                                <div>
                                    <a href="">lost password?</a>
                                </div>
                            </div>
                            <div class="loginrow login-btn mt-2">
                                <button type='submit'>Login</button>
                            </div>
                            <div class="form-footer mt-2">
                                <p class="fs-14 m-0">or</p>
                                <a class="fs-17" href="<?= base_url('signup') ?>">Create an Account</a>
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
           xhr.open("POST","<?= base_url('ajax/signin') ?>", true);
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
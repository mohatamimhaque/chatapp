$(document).ready(function(){
    $("#showpasscode").click(function(){
        const password = document.querySelector("#password");
        if($("#showpasscode").is(":checked")){
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
        }
        else{
            const type = password.getAttribute("type") === "text" ? "password" : "text";
            password.setAttribute("type", type);
        }
   })
   })


   $(document).ready(function(){
    $('.profile-photo input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.profile-photo .show_filename').html(fileName);
    });
    
});
   $(document).ready(function(){
    $("#message").emojioneArea({
        pickerPosition: "top",
    });
    
});
<script>
    

$(document).ready(function(){
    $("#message").emojioneArea({
        pickerPosition: "top"
    });
})
$(document).ready(function(){
    $(".plus").click(function(){
        $(".attach").toggleClass("active");

      });
    $(".attach label").click(function(){
        $(".attach").toggleClass("active");

      });
})

$(document).ready(function(){
    jQuery(document).ready(function () {
        Upload();
      });
      
      function Upload() {
        var imgArray = [];
        var fileArray = [];
      
        $('#image').each(function () {
          $(this).on('change', function (e) {
              var maxLength = $(this).attr('data-max_length');
              var files = e.target.files;
              var filesArr = Array.prototype.slice.call(files);
              var iterator = 0;
              filesArr.forEach(function (f, index) {
                  
                  if (!f.type.match('image.*')) {
                      return;
                    }
                    
                    if (imgArray.length > maxLength) {
                        return false
              } else {
                var len = 0;
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i] !== undefined) {
                        len++;
                    }
                }
                if (len > maxLength) {
                    return false;
                } else {
                    imgArray.push(f);
                    
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(".image-preview").append("<div class='item' data-number = '"+$(".minus").length+"' data-file = '"+f.name+"'><div class='bar minus'><div></div></div><img src='"+e.target.result+"'></div>");
                        iterator++;
                    }
                    reader.readAsDataURL(f);
                }
              }
            });

           
            if(imgArray.length !== 0 || fileArray.length !==0){
                $(".preview").addClass("active");
            }
            else{
                $(".preview").removeClass("active");
            
               }
          });
        });
        $('#file').each(function () {
          $(this).on('change', function (e) {
              var maxLength = $(this).attr('data-max_length');
              var files = e.target.files;
              var filesArr = Array.prototype.slice.call(files);
              var iterator = 0;
              filesArr.forEach(function (f, index) {
                  
                  if (f.type.match('image.*')) {
                      return;
                    }
                    
                    if (fileArray.length > maxLength) {
                        return false
              } else {
                var len = 0;
                for (var i = 0; i < fileArray.length; i++) {
                    if (fileArray[i] !== undefined) {
                        len++;
                    }
                }
                if (len > maxLength) {
                    return false;
                } else {
                  fileArray.push(f);
                    
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(".file-preview").append("<div class='item' data-number = '"+$(".minus").length+"' data-file = '"+f.name+"'><div class='bar minus'>   <div></div> </div><p>"+f.name+"</p></div>");
                        iterator++;
                    }
                    reader.readAsDataURL(f);
                }
              }
            });

           
            if(imgArray.length !== 0 || fileArray.length !==0){
                $(".preview").addClass("active");
            }
            else{
                $(".preview").removeClass("active");
            
               }
          });
        });
        
        $('.image-preview').on('click', ".minus", function (e) {
          var file = $(this).parent().data("file");
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
              imgArray.splice(i, 1);
              break;
            }
          }
          $(this).parent().remove();
          if(imgArray.length !== 0 || fileArray.length !==0){
            $(".preview").addClass("active");
        }
        else{
            $(".preview").removeClass("active");
        
           }
        });
        $('.file-preview').on('click', ".minus", function (e) {
          var file = $(this).parent().data("file");
          for (var i = 0; i < fileArray.length; i++) {
            if (fileArray[i].name === file) {
              fileArray.splice(i, 1);
              break;
            }
          }
          $(this).parent().remove();
          if(imgArray.length !== 0 || fileArray.length !==0){
            $(".preview").addClass("active");
        }
        else{
            $(".preview").removeClass("active");
        
           }
        });









  
    $("#send_message").click(function(){
      var fd = new FormData();
      var message = $('#message').val();
      fd.append('message', message);
      fd.append('sender',$('#sender').val());
      fd.append('receiver',$('#receiver').val());
      if(imgArray.length !== 0){
        for (var x = 0; x < imgArray.length; x++) {
          fd.append("image[]", imgArray[x]);
        }
      }
      if(fileArray.length !== 0){
          for (var x = 0; x < fileArray.length; x++) {
          fd.append("file[]", fileArray[x]);
        }
      }
      if(imgArray.length !== 0 || fileArray.length !== 0 || message !== ''){
      $.ajax({
        url:"<?= base_url('ajax/insert-chat') ?>",
        contentType: false,
        processData: false,
        type: 'POST',
        data: fd,
          success: function(response){
            //alert(response);
            imgArray = [];
            fileArray = [];
            if(imgArray.length === 0 && fileArray.length ===0){
              $(".preview").removeClass("active");
             }
            $(".image-preview").html('');
            $(".file-preview").html('');
            $('#message').val('');
            $(".emojionearea-editor").html('');
            


           

          },
      });
    };
                    
  

      })



    }

      });







         
</script>

<style>

.preview::-webkit-scrollbar{
height:5px;
 border-radius: 10px;
 }
 .preview{
  margin-bottom:3px
 }

 
 .img_show{
    width:200px;
    padding-top:20px ;
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(60px,1fr));
    grid-column-gap: 4px;
    grid-row-gap:4px;
    flex-direction: column-reverse;
  overflow-anchor: none !important;
  scroll-snap-stop: normal !important;
  overscroll-behavior: unset !important;
  scroll-behavior: unset !important;
  }

  .img_show img{
    width:100%;
    height:100%;
    border-radius: 4px;
  }
  .file_show .item{
    width:100%;
    height:auto;
    border-radius: 4px;
    background-color: #e4e4e4;
    padding: 8px 5px;
    margin:3px 0px;
  }
  .file_show a{
    width:100%;
    height:100%;
    border-radius: 4px;
    text-decoration: none;
    color: #21242d;
    font-weight: 600;
  }
</style>

<style>
    .skiptranslate iframe{
        display:none;
    }
    #google_translate_element .goog-te-combo{
        display:flex;
    }
    #google_translate_element span{
        display:none;
    }
</style>
    
<script>
    $(document).ready(function(){
        $('#logout_btn').click(function(){   
            $.ajax({
                url:"<?= base_url('ajax/logout') ?>",
                method:"POST",
                data:{logout_btn:'logout'},
                success:function(data){
                location.reload();
        }

    })
    })
    })
</script>



<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
  function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
} 
</script>
<script>
    $(document).ready(function(){
       var res = $(".goog-te-gadget").contents().get(2);
        $(res).remove();
    })
</script>
<script src='<?= base_url('assets/js/emojionearea.min.js') ?>'></script>
</body>
</html>
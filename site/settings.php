
<?php 
    session_start();
	require_once('inc/inc.php');
	require_once('templates/header.php');
    require_once('inc/auth.php');
?>

<div class="row content body well">
	<?php 
          require_once('templates/nav.php'); 
          require_once('templates/settings_body.php'); 
    ?>
</div>

<script>
 $(function() {
 $("button#submit-post").click(function(){
         $.ajax({
     type: "POST",
 url: "process/process_settings.php",
 data: $('form.form-horizontal').serialize(),
         success: function(msg){
                 if ( msg.includes("Profile Updated!") ) {
                    setTimeout(function(){
                        location.reload();
                    },600);
                 }
                 $("#post-message").html(msg);
                 $("#alert_message").delay(200).fadeTo(200,0).slideUp(200);
         },
 error: function(){
 alert("failure");
 }
       });
 });
});
</script>
<?php require_once('templates/footer.php'); ?>


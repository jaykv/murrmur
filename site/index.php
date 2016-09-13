<?php 
	require_once('inc/inc.php');
	require_once('templates/header.php');
?>

<div class="row content body well">

	<?php require_once('templates/nav.php'); ?>
	
	<div class="col-sm-9 main"> 
        <?php  
        if (isset($_SESSION["handle"])) 
            show_post_box();
        ?>
        <div id="auto-refresh"></div>
	</div>
</div>

<script>     
/* this is for load more on scroll - needs more work - for another time*/
/*$(window).scroll(function () {
    if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
        alert("End Of The Page");
    }
 });*/
 
 /*
 var sIndex = 1, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
 $(window).scroll(function () {
 if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
   
  if (isPreviousEventComplete && isDataAvailable) {
     alert("test");
    isPreviousEventComplete = false;
    $(".LoaderImage").css("display", "block");

    $.ajax({
      type: "GET",
      url: 'getMorePosts.ashx?startIndex=' + sIndex + '&offset=' + offSet + '',
      success: function (result) {
        $(".divContent").append(result);

        sIndex = sIndex + offSet;
        isPreviousEventComplete = true;

        if (result == '') //When data is not available
            isDataAvailable = false;

        $(".LoaderImage").css("display", "none");
      },
      error: function (error) {
          alert(error);
      }
    });

  }
 }
});*/
    
function startInterval(seconds, callback) {
  callback();
  return setInterval(callback, seconds * 1000);
}

function reloadChat () {
     $('#auto-refresh').load('process/posts_update.php');
}

startInterval(1, reloadChat);  

 $(function() {
 $("button#submit-post").click(function(){
         $.ajax({
     type: "POST",
 url: "process/process_post.php",
 data: $('form.user-post').serialize(),
         success: function(msg){
                 document.getElementById("user_post").value = "";
                 $("#post-message").html(msg);
                 $("#alert_message").delay(300).fadeTo(200,0).slideUp(200);
         },
 error: function(){
 alert("failure");
 }
       });
 });
});
</script>
<?php require_once('templates/footer.php'); ?>


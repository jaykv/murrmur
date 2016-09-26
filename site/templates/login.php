<?php
    require_once("forgot.php");
?>
<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <div id="login-message"></div>
        <form class="login">

            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
              <input class="form-control" type="text" name="email" placeholder="Email address">
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberme"> Remember me</label>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgot">Forgot password</a>
            </div>
            <button type="button" class="form-control btn btn-primary" id="submit">Login</button>
        </form>
      </div>
    </div>

  </div>
</div>
<script>
$('#login input').keydown(function(e) {
    if (e.keyCode == 13) {
        $('button#submit').click();
    }
});

 $(function() {
 $("button#submit").click(function(){
         $.ajax({
     type: "POST",
 url: "process/process_login.php",
 data: $('form.login').serialize(),
         success: function(msg){
                  // grab the result from backend
                  if (msg.includes("Success")) {
                    window.location.reload(true);
                  }
                 $("#login-message").html(msg)
         },
 error: function(){
 }
       });
 });
});
</script>

<!-- Modal -->
<div id="register" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign Up</h4>
      </div>
      <div class="modal-body">
        <div id="thanks2"></div></br>
        <form class="registr">
            
            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
              <input class="form-control" type="text" name="handle" placeholder="Handle">
            </div>
          
            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
              <input class="form-control" type="text" name="email" placeholder="Email address">
            </div>
            
            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            
            <div class="input-group" style="margin-bottom: 15px;">
              <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
              <input class="form-control" type="password" name="repeatpass" placeholder="Repeat Password">
            </div>
            
            <div class="input-group" style="margin-bottom: 15px;">
                <span class="input-group-addon"><i class="fa fa-graduation-cap fa-fw"></i></span>
                <select class="chooseUni form-control" style="width: 100%;" name="university">
					<?php 
						
                        $connection = new PDOConnection();
						$connection->query('SELECT * FROM universities');
						$schools = $connection->allResults();
						
						foreach($schools as &$school)
						{
							echo "<option value='" . $school['university_id'] . "'>" . $school['Name'] . "</option>";
						}
					?>
                </select>
            </div>
            
            <button type="button" class="form-control btn btn-primary" id="submitreg">Sign up</button>
        </form>
      </div>
    </div>

  </div>
</div>
<script>
 $(function() {
//twitter bootstrap script
 $("button#submitreg").click(function(){
         $.ajax({
     type: "POST",
 url: "templates/process_register.php",
 data: $('form.registr').serialize(),
         success: function(msg){
                 $("#thanks2").html(msg)
        $("#form-content").modal('hide'); 
         },
 error: function(){
 alert("Woops, encountered a failure!");
 }
       });
 });
});
</script>
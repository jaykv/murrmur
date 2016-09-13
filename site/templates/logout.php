
<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	session_destroy();
	header('Location: ../'); // . $_SERVER['HTTP_REFERER']);
?>

<div id="logout" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Logged out</h4>
      </div>
      <div class="modal-body">
           You have been logged out.
      </div>
    </div>

  </div>
</div>
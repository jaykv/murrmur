<?php
    ob_start();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Test</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../addons/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../addons/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/nav.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../addons/bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/count.js"></script>

        <link href="../addons/select2/dist/css/select2.min.css" rel="stylesheet" />
        <script src="../addons/select2/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
              $(".chooseUni").select2({
                placeholder: "Select a University",
                allowClear: true
              });
            });

            //$('.toggle-btn').click(function() {
            //  $(this).next('.nav-side-menu').slideToggle(500);
           // });
        </script>

    </head>
    <body>
        <?php
            require_once("login.php");
            require_once("register.php");
        ?>
        <div class="container">
			<div class="mobile-wrapper">
				<div class="row content header well">
					<div class="col-xs-6 text-left" style="color: white;">
						<h3 style="display: inline;">
							<strong>murrmur</strong>
						</h3>
					</div>
					<div class="col-xs-6 text-right mobile_expand">
					  <button class="btn btn-primary toggle-btn" type="button" data-toggle="collapse" data-target="#nav-content" aria-expanded="false" aria-controls="nav-content">
						<i class="fa fa-bars"></i>
					  </button>
					</div>
				</div>
				<div class="mobile-navbar">
					<?php include("nav.php"); ?>
				</div>
			</div>

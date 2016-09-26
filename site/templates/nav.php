<?php
	require_once("login.php");
	require_once("register.php");
?>
<div class="nav-content collapse" id="nav-content">
	<div class="col-sm-3 nav-side-menu">
		<div class="brand">
			
				<?php
					if(isset($_SESSION["handle"]))
					{
						echo "<li class='userInfo text-center'>";
						echo "<span>" . getUniversityName($_SESSION["university_id"]). "</span>";
						echo "<span class='fa fa-user fa-fw fa-4x circle' aria-hidden='true'></span>";
						echo "<span><a href='#'>" . $_SESSION["handle"]. "</a> (" . $_SESSION["score"] . " pts)</span>";
						echo "</li>";
					}
				?>
			
		</div>
	  
			<div class="menu-list">
	  
				<ul class="menu-content">
				
					<li>
						<a href="/">
							<i class="fa fa-home fa-lg"></i> Home
						</a>
					</li>
					<?php
						if (!isset($_SESSION["handle"]))
						{
					?>
							<li>
								<a href="#" data-toggle="modal" data-target="#login">
									<i class="fa fa-sign-in fa-lg"></i> Login
								</a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#register">
									<i class="fa fa-pencil-square-o fa-lg"></i> Register
								</a>
							</li>
					<?php
						}
						else
						{
					?>
							<li>
								<a href="top.php">
									<i class="fa fa-star fa-lg"></i> Top
								</a>
							</li>
						
							<li>
								<a href="mine.php">
								<i class="fa fa-heart fa-lg"></i> Mine
								</a>
							</li>
							
							<li>
								<a href="top-users.php">
									<i class="fa fa-users fa-lg"></i> Top Users
								</a>
							</li>
							
							<li>
								<a href="top-universities.php">
									<i class="fa fa-graduation-cap fa-lg"></i> Top Universities
								</a>
							</li>
							
							<li>
								<a href="settings.php">
									<i class="fa fa-cog fa-lg"></i> Account info
								</a>
							</li>

							<li>
								<a href="#" onclick="location.href='templates/logout.php';">
									<i class="fa fa-sign-out fa-lg"></i> Logout
								</a>
							</li>
					<?php
						}
					?>

				</ul>
		 </div>
	</div>
</div>
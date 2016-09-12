
<?php 
	require_once('inc/inc.php');
	require_once('templates/header.php');
    require_once('inc/auth.php');
?>

<div class="row content body well">

	<?php require_once('templates/nav.php'); ?>
	
	
	<div class="col-sm-9 main">
		<div class="page-header text-right">
			<h3>Account info</h3>
		</div>
		
		<?php
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM users WHERE user_id = :uid');
            $connection->bind('uid', 1);
			$result= $connection->oneResult();
		?>
		
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-xs-4">Handle:</label>
				<div class="col-xs-8" style="padding-right: 20%;">
					<?php
						echo "<input type='text' class='form-control' id='handle' placeholder='". $result['handle'] . "'>";
					?>
					<div class="info">
						What makes you different than everyone else?
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-4">University:</label>
				<div class="col-xs-8" style="padding-right: 20%;">
					<select class="chooseUni form-control">
						<?php
							$connection->query('SELECT * FROM universities');
							$schools = $connection->allResults();
							
							foreach($schools as &$school)
							{
								 if($school['UniversityID'] == $result['university_id'])
								 {
									 echo "<option selected='selected'>" . $school['Name'] . "</option>";
								 }
								 else
								 {
									 echo "<option>" . $school['Name'] . "</option>";
								 }
							}
						?>
					</select>
					<div class="info">
						Where do you call home?
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-4">Notifications:</label>
				<div class="col-xs-8">
					<div class="radio">
					  <?php
					      if($result['notification'] == 0)
						  {
								
					  ?>
						      <label><input type="radio" name="notifs">Yes</label>
					          <label><input type="radio" name="notifs" checked="checked">No</label>
					  <?php
						  }
						  else
						  {
					  ?>
					  		  <label><input type="radio" name="notifs" checked="checked">Yes</label>
					          <label><input type="radio" name="notifs">No</label>
				      <?php    
						  }
					  ?>
					</div>
					<div class="info">
						Do you want to stay connected?
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-4">Top user recording:</label>
				<div class="col-xs-8">
					<div class="radio">
					  <?php
					      if($result['isViewableInTop'] == 0)
						  {
								
					  ?>
						      <label><input type="radio" name="topuser">Yes</label>
					          <label><input type="radio" name="topuser" checked="checked">No</label>
					  <?php
						  }
						  else
						  {
					  ?>
					  		  <label><input type="radio" name="topuser" checked="checked">Yes</label>
					          <label><input type="radio" name="topuser">No</label>
				      <?php    
						  }
					  ?>
					</div>
					<div class="info">
						Do you want to brag?
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4 col-xs-offset-4">
					<button type="button" class="form-control btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php require_once('templates/footer.php'); ?>


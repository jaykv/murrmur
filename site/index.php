
<?php 
	require_once('inc/inc.php');
	require_once('templates/header.php');
?>

<div class="row content body well">

	<?php require_once('templates/nav.php'); ?>
	
	<div class="col-sm-9 main">
		<?php
			$connection = new PDOConnection();
		
			if (isset($_SESSION["handle"]))
			{
				
		?>
				<div class="form-group">
					<textarea id="user_post" class="form-control" rows="3" placeholder="Share something..." maxlength="150"></textarea>
				</div>
				<div class="form-group text-right">
					<div id="count" style="display: table-cell; display: inline; margin: 0 15px: 0 0;"></div>
					<input class="btn btn-default" type="submit" value="Submit">
				</div>
		<?php
				$connection->query('SELECT * FROM posts WHERE university_id = :uni_id AND deleted=0 ORDER by time DESC');
				$connection->bind('uni_id', $_SESSION["university_id"]);
			}
			else
			{
				$connection->query('SELECT *, likes - dislikes AS score FROM posts WHERE deleted=0 ORDER by score DESC');
			}
			
			$results = $connection->allResults();
			foreach ($results as &$result)
			{
		?>
				<div class="panel panel-default">
					<div class="panel-heading">
					<?php
						// Divs are off because of this if statement but they are not wrong!
						if ( ($result['likes'] - $result['dislikes']) >= 0)
						{
							echo "<div class='left-panel positive'>";
						}
						else
						{
							echo "<div class='left-panel negative'>";
						}
						
						echo $result['likes'] - $result['dislikes'];
						echo "</div>";                        
					?>  
						<div class="right-panel text-right">
							<?php echo niceTime($result['time']); ?>
							<button type="submit">
								<span title="Report" class="fa fa-flag fa-fw fa-lg" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					<div class="panel-body" style="padding-bottom: 5px;">
						<div class="col-xs-9">
							<div class="row content" style="padding-left: 15px; padding-bottom: 15px;" >
								<?php echo $result['content']; ?>
							</div>
							<div class="row content text-left" style="margin-left: none; font-size:10px;">
								<span class="fa fa-comments" aria-hidden="true"></span> <a href="#"><?php echo $result['comments']; ?> comments</a>
							</div>
						</div>
						<div class="col-xs-3 text-right">
							<button type="submit">
								<span title="Like" class="fa fa-angle-up fa-fw fa-2x" aria-hidden="true"></span>
							</button>
							<button type="submit">
								<span title="Dislike" class="fa fa-angle-down fa-fw fa-2x" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				</div>
	
		<?php
			}
		?>
	</div>
</div>

<?php require_once('templates/footer.php'); ?>


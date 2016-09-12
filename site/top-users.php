
<?php 
	require_once('inc/inc.php');
	require_once('templates/header.php');
    require_once('inc/auth.php');
?>
<div class="row content body well">

	<?php require_once('templates/nav.php'); ?>

	<div class="col-sm-9 main">
	
		<table class="table table-striped">
			<tr>
				<th>Handle</th>
				<th>Score</th>
			</tr>
		<?php
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM users WHERE university_id = :uni_id ORDER by score DESC');
			$connection->bind('uni_id', 21);
			$results = $connection->allResults();
			foreach ($results as &$result)
			{
		?>
				<tr>
					<td><?php echo $result['handle']; ?></td>
					<td><?php echo $result['score']; ?></td>
				</tr>
		<?php
			}
		?>
		
		</table>
	</div>	

</div>

<?php require_once('templates/footer.php'); ?>


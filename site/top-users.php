
<?php 
	require_once('inc/inc.php');
	require_once('templates/header.php');
    require_once('inc/auth.php');
?>
<div class="row content body well">

	<div class="regular-navbar">
		<?php include('templates/nav.php'); ?>
	</div>
	
	<div class="col-sm-9 main">
	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Handle</th>
					<th>Score</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM users WHERE university_id = :uni_id ORDER by score DESC LIMIT 16');
			$connection->bind('uni_id', $_SESSION["university_id"]);
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
			</tbody>
		
		</table>
	</div>	

</div>

<?php require_once('templates/footer.php'); ?>


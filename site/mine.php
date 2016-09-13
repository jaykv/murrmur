
<?php
    require_once('inc/inc.php');
    require_once('templates/header.php');
    require_once('inc/auth.php');
?>

<div class="row content body well">

	<?php require_once('templates/nav.php'); ?>
	
	<div class="col-sm-9 main">
		<?php
            show_post_box();
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM posts WHERE university_id = :uni_id AND user_id = :uid ORDER by time DESC');
			$connection->bind('uni_id', $_SESSION["university_id"]);
            $connection->bind('uid', $_SESSION["user_id"]);
			$results = $connection->allResults();
			foreach ($results as &$result)
			{
                show_message( $result['content'], $result['time'], $result['likes'], $result['dislikes'], $result['comments'] );
            }
        ?>
	</div>
</div>

<?php require_once('templates/footer.php'); ?>


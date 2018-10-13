<?php

/**
 * display selected songs 
 */
require "../config.php";
require "../common.php";
try {	
		

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM `songs`
					WHERE selected = 1
					ORDER by RAND()
					";

		$selected = $_POST['selected'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':selected', $selected, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}

?>
<?php require "templates/header.php"; ?>
	<form id="fixedRefresh" method="post">
					<input type="submit" name="submit" value="Refresh">
				</form>
				
	<div id="playlist">
		<?php  
				if ($result && $statement->rowCount() > 0) { ?>								
				<?php foreach ($result as $row) { ?>
						<p>"<?php echo escape($row["songname"]);?>", <?php echo escape($row["artist"]);?></p>
						
					<?php } ?> 
						
				
				<?php } else { ?>
					<blockquote><p>No songs :(</p></blockquote>
				<?php } 
			?> 
	</div>
				
				
				
<div id="fullpage">

	<div class ="section">
		<div class="maincontent">
			<h1>Campfire</h1>
			<img id="fire"src="images/flame_icon.png"> 
			<br>
			<br>
				
				
				
			
			
		</div>
	</div>
	
	
	<?php  
				if ($result && $statement->rowCount() > 0) { ?>								
				<?php foreach ($result as $row) { ?>
						<div class ="section" style="background-color: #<?php echo escape($row["color"]);?>">
						
							<iframe data-autoplay width="560" height="315" src="<?php echo escape($row["url"]);?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							
						</div>	
					<?php } ?> 
						
				
				<?php } else { ?>
					<blockquote></p>No songs :(</p></blockquote>
				<?php } 
			?> 
		
	
	
	
	
	
	
	



</div>

















<script type="text/javascript" src="js/fullpage.js"></script>
<script type="text/javascript">
		 new fullpage('#fullpage', {
			//options here
			autoScrolling:true,
			scrollHorizontally: true
});

//methods
fullpage_api.setAllowScrolling(true);
</script>

<?php require "templates/footer.php"; ?>
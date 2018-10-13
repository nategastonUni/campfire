<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM `songs`
					WHERE selected = 1
					ORDER by RAND()
					LIMIT 1";

		$selected = $_POST['selected'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':selected', $selected, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		

<h2>Find user based on location</h2>

<form method="post">
	<label for="selected">Selected</label>
	<input type="text" id="selected" name="selected">
	<input type="submit" name="submit" value="View Results">
</form>

<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Song</th>
					<th>Artist</th>
					<th>URL</th>
					
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["songname"]); ?></td>
				<td><?php echo escape($row["artist"]); ?></td>
				<td><?php echo escape($row["url"]); ?></td>
				<td><iframe width="100" height="56" src="<?php echo escape($row["url"]); ?>" 
				frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td>
				
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['se']); ?>.</blockquote>
	<?php } 
} ?> 




<a href="index.php">Back to home</a>



<?php require "templates/footer.php"; ?>
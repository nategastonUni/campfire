<?php
require "../config.php";
require "../common.php";

/** 
* loading in the song details
*/
 try {
	 $connection = new PDO($dsn, $username, $password, $options);
	 $sql = "SELECT * FROM songs
			WHERE user = 'two' ";

	$statement = $connection->prepare($sql);
	$statement->execute();

	$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}


/**
* Store and use checked values 
*
*/

if(isset($_POST['submit'])){ //when 'submit' is used

			if(!empty($_POST['testing1'])){
				
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['testing1'] as $selectedsid){
					//update song's selected value 
					try {
												
						//set a value for SQL as selectedsid
						
						$connection = new PDO($dsn, $username, $password, $options);
						$sql = "UPDATE songs SET selected=1 WHERE id=$selectedsid";
						
						$statement = $connection->prepare($sql);
						$statement->execute();
						
						$result = $statement->fetchAll();
						} catch(PDOException $error) {
							//echo $sql . "<br>" . $error->getMessage();
						}	
				}
			}	
	}
	
	
	
	
	
/**
 * Select user 2's songs when pressing submit.
 */
if (isset($_POST['testing5'])){
	
	
	try{
		$conn = new PDO($dsn,$username,$password,$options);
		//error mode?
		
		$sql ="UPDATE `songs` SET selected = 1 WHERE user = 'two'";
		
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//execute
		$stmt->execute();
		
		//echo to say success

		}
		catch(PDOException $error)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		
	$conn = null;
}

/**
* Update entire table, removing "selected" value (should move to template at some point. 
*/
if (isset($_POST['clear'])){
	try{
		$conn = new PDO($dsn,$username,$password,$options);
		//error mode?
		
		$sql ="UPDATE `songs` SET selected = 0 WHERE user='two'";
		
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//execute
		$stmt->execute();
		
		//echo to say success

		}
		catch(PDOException $error)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		
	$conn = null;
}
  
  
	
  
?>
<?php require "templates/header.php"; ?>

<div class ="mobile" id="u2">             
<div class ="mHeader">
			<img src="images/flame_icon.png">
			<h2>User Two</h2>
		</div>
		
		<div class ="mContent">
				<form method ="post" action="#">
				<p>Choose your favourite Songs</p>
				<?php foreach ($result as $row) : ?>
					<p>
					
					"<?php echo escape($row["songname"]);?>" by <?php echo escape($row["artist"]);?> |
					<input type="checkbox" name="testing1[]" id="testing1" value ="<?php echo escape($row["id"]);?>">	
					</p>  
				<?php endforeach; ?>
				
				<input type="submit" name="submit" value="Submit">
				
			</form>
	
	<?php
		//to run PHP script on submit
		if(isset($_POST['submit'])){
			if(!empty($_POST['testing1'])){
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['testing1'] as $selected){
					echo $selected."</br>";
				}
			}
		}
	?>
		
			<div class="mCenter">
				<form method ="post" action="#">
				<p>Still Listening?</p>
				<input type="submit" name="clear" value="Not Anymore">
			</form>
			</div>
		
		</div>


	


</div>
<?php require "templates/footer.php"; ?>
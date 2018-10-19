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

	
	/**
* Update entire table, removing "selected" value (should move to template at some point. 
*/
if (isset($_POST['clear'])){
	try{
		$conn = new PDO($dsn,$username,$password,$options);
		//error mode?
		
		$sql ="UPDATE `songs` SET selected = 0 ";
		
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
	
	
/*populate
*
*/
if (isset($_POST['fill'])){
	try{
		$conn = new PDO($dsn,$username,$password,$options);
		//error mode?
		
		$sql ="UPDATE `songs` SET selected=1";
		
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


if (isset($_POST['refresh'])){
	try{
		$conn = new PDO($dsn,$username,$password,$options);
		//error mode?
		
		$sql ="SELECT * FROM`songs` WHERE selected=1";
		
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
	<form id="fixedRefresh" method="post">
					<input type="submit" name="refresh" value="Refresh">
					
					
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
					
		<form id="clearbut" method="post"><input type="submit" name="clear" value="clear"><input type="submit" name="fill" value="fill"></form>
	</div>
				
				
				
<div id="fullpage">

	<div class ="section">
		<div class="maincontent">
			<h1>Campfire</h1>
			<form  method="post">
				<img id="fire" src="images/flame_icon.png" alt="fill"/>
				
			
		
			</form> 
			<br>
			<br>
			
				
				
				
			
			
		</div>
	</div>
	
	
	<?php  
				if ($result && $statement->rowCount() > 0) { ?>								
				<?php foreach ($result as $row) { ?>
						<div class ="section" style="background-color: #<?php echo escape($row["color"]);?>">
							<div class="audioDiv">
								<h2>"<?php echo escape($row["songname"]);?>", <?php echo escape($row["artist"]);?></h2>
								<audio id="<?php echo escape($row["id"]);?>" controls data-autoplay>
									<source src="videos/<?php echo escape($row["mp3url"]);?>" type="audio/mp3">
								</audio>
								
								
								
								
							</div>
							
						</div>	
						
						
						
					<?php } ?> 
						
				
				<?php } else { ?>
					<blockquote></p>No songs :(</p></blockquote>
				<?php } 
			?> 
		
	
	
	
	
	
	
	



</div>
















<script>
	//listeners
	
	//to play music: W
	document.addEventListener('keydown', function(e) {
		if (e.keyCode == 87) {
			getPage();
			playMusic();
			}
			});
	//to stop Music: A 		
	document.addEventListener('keydown', function(e) {
		if (e.keyCode == 65) {
			getPage();
			stopMusic();
			}
			});

</script>

<script type="text/javascript" src="js/fullpage.js"></script>

<script type="text/javascript">
var currentPage;
	 new fullpage('#fullpage', {
		//options here
			 
		autoScrolling:true,
		scrollHorizontally: false,
		licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE'
		
	});

	//functions
	function scrollDown(){
		fullpage_api.moveSectionDown();
	}

	function getPage(){
		//store data about the current page
		currentPage = (fullpage_api.getActiveSection().item.children["0"].firstElementChild.childNodes[3].id);
		logPage();
		
	}
	
	
	function logPage(){
		console.log(currentPage);
	}
	
	function playMusic(){
		document.getElementById(currentPage).play();
	}
	
	function stopMusic(){
		document.getElementById(currentPage).pause();
	}
	
	//methods
	fullpage_api.setAllowScrolling(true);
</script>


<?php require "templates/footer.php"; ?>
<div class ="mContent">
				<form method ="post" action="#">
				<h3>Choose your favourite Songs</h3>
				<?php foreach ($result as $row) : ?>
					<p>
					
					
					<label><input type="checkbox" name="testing1[]" id="testing1" value ="<?php echo escape($row["songname"]);?>">	
					"<?php echo escape($row["songname"]);?>" by <?php echo escape($row["artist"]);?></label>
					
					</p>  
				<?php endforeach; ?>
				
				<input type="submit" name="submit" value="Submit">
				
			</form>
	
	
		
			<div class="mCenter">
				<form method ="post" action="#">
				<h4>Still Listening?</h4>
				<input type="submit" name="clear" value="Not Anymore">
			</form>
			</div>
			
			<h3>Your Songs:</h3>
				<?php
		//to run PHP script on submit
		if(isset($_POST['submit'])){
			if(!empty($_POST['testing1'])){
				
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['testing1'] as $selected){
					echo "<li> $selected </li>";
				}
			}
		}
	?>
			
			
		
		</div>
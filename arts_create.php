<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$art_descriptionError = null;
		$artist_idError = null;
		$art_ratingError = null;
		$exhibit_idError = null;
		
		// keep track post values
		$art_description = $_POST['art_description'];
		$artist_id = $_POST['artist_id'];
		$art_rating = $_POST['art_rating'];
		$exhibit_id = $_POST['exhibit_id'];
		
		// validate input
		$valid = true;
		if (empty($art_description)) {
			$art_descriptionError = 'Please enter Art';
			$valid = false;
		}
		
		if (empty($artist_id)) {
			$artist_idError = 'Please enter artist_id';
			$valid = false;
		} 
		
		if (empty($art_rating)) {
			$art_ratingError = 'Please enter Art Rating';
			$valid = false;
		}
		
		if (empty($exhibit_id)) {
			$exhibit_idError = 'Please enter Art Exhibit';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			// here is the line to check and see where you are going after a command
			//echo "got to here."; exit(); //arames1
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO arts (art_description,artist_id,art_rating,exhibit_id) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($art_description,$artist_id,$art_rating,$exhibit_id));
			Database::disconnect();
			header("Location: arts_create.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a New Piece of Art</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="arts_create.php" method="post">
					  <div class="control-group <?php echo !empty($art_descriptionError)?'error':'';?>">
					    <label class="control-label">Art Description/Name</label>
					    <div class="controls">
					      	<input name="art_description" type="text"  placeholder="Art Description" value="<?php echo !empty($art_description)?$art_description:'';?>">
					      	<?php if (!empty($art_descriptionError)): ?>
					      		<span class="help-inline"><?php echo $art_descriptionError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <select name="artist_id">
					  <?php 
					   //include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM Artists ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<option value ="' . $row['id'] . '">' . $row['name'] . '</option>';
					   }
					   Database::disconnect();
					  ?>
					  </select>
					  
					  <!--
					  <div class="control-group <?php echo !empty($artist_idError)?'error':'';?>">
					    <label class="control-label">artist_id</label>
					    <div class="controls">
					      	<input name="artist_id" type="text" placeholder="artist_id" value="<?php echo !empty($artist_id)?$artist_id:'';?>">
					      	<?php if (!empty($artist_idError)): ?>
					      		<span class="help-inline"><?php echo $artist_idError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  -->
					  
					  
					  <div class="control-group <?php echo !empty($art_ratingError)?'error':'';?>">
					    <label class="control-label">Art Rating</label>
					    <div class="controls">
					      	<input name="art_rating" type="text"  placeholder="Art Rating" value="<?php echo !empty($art_rating)?$art_rating:'';?>">
					      	<?php if (!empty($art_ratingError)): ?>
					      		<span class="help-inline"><?php echo $art_ratingError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($exhibit_idError)?'error':'';?>">
					    <label class="control-label">Past Art Exhibits</label>
					    <div class="controls">
					      	<input name="exhibit_id" type="text"  placeholder="Art Exhibit" value="<?php echo !empty($exhibit_id)?$exhibit_id:'';?>">
					      	<?php if (!empty($exhibit_idError)): ?>
					      		<span class="help-inline"><?php echo $exhibit_idError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="arts_create.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
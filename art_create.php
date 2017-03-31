<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$art_descriptionError = null;
		$artistError = null;
		$art_ratingError = null;
		$art_exhibitError = null;
		
		// keep track post values
		$art_description = $_POST['art_description'];
		$artist = $_POST['artist'];
		$art_rating = $_POST['art_rating'];
		$art_exhibit = $_POST['art_exhibit'];
		
		// validate input
		$valid = true;
		if (empty($art_description)) {
			$art_descriptionError = 'Please enter Art';
			$valid = false;
		}
		
		if (empty($artist)) {
			$artistError = 'Please enter Artist';
			$valid = false;
		} 
		
		if (empty($art_rating)) {
			$art_ratingError = 'Please enter Art Rating';
			$valid = false;
		}
		
		if (empty($art_exhibit)) {
			$art_exhibitError = 'Please enter Art Exhibit';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			// here is the line to check and see where you are going after a command
			//echo "got to here."; exit(); //arames1
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Art (art_description,artist,art_rating,art_exhibit) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($art_description,$artist,$art_rating,$art_exhibit));
			Database::disconnect();
			header("Location: art.php");
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
    		
	    			<form class="form-horizontal" action="art_create.php" method="post">
					  <div class="control-group <?php echo !empty($art_descriptionError)?'error':'';?>">
					    <label class="control-label">Art Description/Name</label>
					    <div class="controls">
					      	<input name="art_description" type="text"  placeholder="Art Description" value="<?php echo !empty($art_description)?$art_description:'';?>">
					      	<?php if (!empty($art_descriptionError)): ?>
					      		<span class="help-inline"><?php echo $art_descriptionError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($artistError)?'error':'';?>">
					    <label class="control-label">Artist</label>
					    <div class="controls">
					      	<input name="artist" type="text" placeholder="Artist" value="<?php echo !empty($artist)?$artist:'';?>">
					      	<?php if (!empty($artistError)): ?>
					      		<span class="help-inline"><?php echo $artistError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($art_ratingError)?'error':'';?>">
					    <label class="control-label">Art Rating</label>
					    <div class="controls">
					      	<input name="art_rating" type="text"  placeholder="Art Rating" value="<?php echo !empty($art_rating)?$art_rating:'';?>">
					      	<?php if (!empty($art_ratingError)): ?>
					      		<span class="help-inline"><?php echo $art_ratingError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($art_exhibitError)?'error':'';?>">
					    <label class="control-label">Past Art Exhibits</label>
					    <div class="controls">
					      	<input name="art_exhibit" type="text"  placeholder="Art Exhibit" value="<?php echo !empty($art_exhibit)?$art_exhibit:'';?>">
					      	<?php if (!empty($art_exhibitError)): ?>
					      		<span class="help-inline"><?php echo $art_exhibitError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="art.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
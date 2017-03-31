<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: art.php");
	}
	
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
			$art_descriptionError = 'Please enter Art Description';
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
			$art_exhibitError = 'Please enter Previous Art Exhibit';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Art  set art_description = ?, artist = ?, art_rating =?, art_exhibit =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($art_description,$artist,$art_rating,$id));
			Database::disconnect();
			header("Location: art.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Art where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$art_description = $data['art_description'];
		$artist = $data['artist'];
		$art_rating = $data['art_rating'];
		$art_exhibit = $data['art_exhibit'];

		Database::disconnect();
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
		    			<h3>Update a Piece of Art</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="art_update.php?id=<?php echo $id?>" method="post">
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
					      	<input name="art_rating" type="text" placeholder="Art Rating" value="<?php echo !empty($art_rating)?$art_rating:'';?>">
					      	<?php if (!empty($art_ratingError)): ?>
					      		<span class="help-inline"><?php echo $art_ratingError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($art_exhibitError)?'error':'';?>">
					    <label class="control-label">Previous Art Exhibits</label>
					    <div class="controls">
					      	<input name="art_exhibit" type="text"  placeholder="Art Exhibit" value="<?php echo !empty($art_exhibit)?$art_exhibit:'';?>">
					      	<?php if (!empty($art_exhibitError)): ?>
					      		<span class="help-inline"><?php echo $art_exhibitError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="art.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
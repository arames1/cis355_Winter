<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: exhibits.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$exhibit_dateError = null;
		$exhibit_timeError = null;
		$exhibit_locationError = null;
		$exhibit_artistsError = null;
		
		
		// keep track post values
		$exhibit_date = $_POST['exhibit_date'];
		$exhibit_time = $_POST['exhibit_time'];
		$exhibit_location = $_POST['exhibit_location'];
		$exhibit_artists = $_POST['exhibit_artists'];

		
		// validate input
		$valid = true;
		if (empty($exhibit_date)) {
			$exhibit_dateError = 'Please enter Exhibit Date';
			$valid = false;
		}
		
		if (empty($exhibit_time)) {
			$exhibit_timeError = 'Please enter Exhibit Time';
			$valid = false;
		} 
		
		if (empty($exhibit_location)) {
			$exhibit_locationgError = 'Please enter Exhibit Location';
			$valid = false;
		}
		
		if (empty($exhibit_artists)) {
			$exhibit_artistsError = 'Please enter Exhibit Artists';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Art  set exhibit_date = ?, exhibit_time = ?, exhibit_location =?, exhibit_artists =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($exhibit_date,$exhibit_time,$exhibit_location,$exhibit_artists,$id));
			Database::disconnect();
			header("Location: exhibits.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Exhibits1 where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$exhibit_date = $data['exhibit_date'];
		$exhibit_time = $data['exhibit_time'];
		$exhibit_location = $data['exhibit_location'];
		$exhibit_artists = $data['exhibit_artists'];

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
		    			<h3>Update an Exhibit</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="exhibit_update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($exhibit_dateError)?'error':'';?>">
					    <label class="control-label">Exhibit Date</label>
					    <div class="controls">
					      	<input name="exhibit_date" type="text"  placeholder="Exhibit Date" value="<?php echo !empty($exhibit_date)?$exhibit_date:'';?>">
					      	<?php if (!empty($exhibit_dateError)): ?>
					      		<span class="help-inline"><?php echo $exhibit_dateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($exhibit_timeError)?'error':'';?>">
					    <label class="control-label">Exhibit Time</label>
					    <div class="controls">
					      	<input name="exhibit_time" type="text" placeholder="Exhibit Time" value="<?php echo !empty($exhibit_time)?$exhibit_time:'';?>">
					      	<?php if (!empty($exhibit_timeError)): ?>
					      		<span class="help-inline"><?php echo $exhibit_timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($exhibit_locationError)?'error':'';?>">
					    <label class="control-label">Exhibit Location</label>
					    <div class="controls">
					      	<input name="exhibit_location" type="text" placeholder="Exhibit Location" value="<?php echo !empty($exhibit_location)?$exhibit_location:'';?>">
					      	<?php if (!empty($exhibit_locationError)): ?>
					      		<span class="help-inline"><?php echo $exhibit_locationError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($exhibit_artistsError)?'error':'';?>">
					    <label class="control-label">Exhibit Artists</label>
					    <div class="controls">
					      	<input name="exhibit_artists" type="text"  placeholder="Exhibit Artists" value="<?php echo !empty($exhibit_artists)?$exhibit_artists:'';?>">
					      	<?php if (!empty($exhibit_artistsError)): ?>
					      		<span class="help-inline"><?php echo $exhibit_artistsError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="exhibits.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
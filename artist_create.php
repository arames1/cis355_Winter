<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$class_statusError = null;
		$previous_worksError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$class_status = $_POST['class_status'];
		$previous_works = $_POST['previous_works'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($class_status)) {
			$class_statusError = 'Please enter a Class Status';
			$valid = false;
		} 
		
		
		if (empty($previous_works)) {
			$previous_worksError = 'Please enter a Previous Work';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			// here is the line to check and see where you are going after a command
			//echo "got to here."; exit(); //arames1
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Artists (name,class_status,previous_works) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$class_status,$previous_works));
			Database::disconnect();
			header("Location: Artists.php");
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
		    			<h3>Create an Artist</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="artist_create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($class_statusError)?'error':'';?>">
					    <label class="control-label">Class Status</label>
					    <div class="controls">
					      	<input name="class_status" type="text" placeholder="Class Status" value="<?php echo !empty($class_status)?$class_status:'';?>">
					      	<?php if (!empty($class_statusError)): ?>
					      		<span class="help-inline"><?php echo $class_statusError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($previous_worksError)?'error':'';?>">
					    <label class="control-label">Previous Works</label>
					    <div class="controls">
					      	<input name="previous_works" type="text"  placeholder="Previous Works" value="<?php echo !empty($previous_works)?$previous_works:'';?>">
					      	<?php if (!empty($previous_worksError)): ?>
					      		<span class="help-inline"><?php echo $previous_works;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="Artists.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
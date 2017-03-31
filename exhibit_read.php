<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: exhibits.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Exhibits1 where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    			<h3>Read an Art Exhibit</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Exhibit Date</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['exhibit_date'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Exhibit Time</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['exhibit_time'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Exhibit Location</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['exhibit_location'];?>
						    </label>
					    </div>
					  </div>
					  	<div class="control-group">
					    <label class="control-label">Exhibit Artists</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['exhibit_artists'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="exhibits.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
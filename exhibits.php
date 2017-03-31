<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Exhibits</h3>
    		</div>
			<div class="row">
				<p>
					<a href="exhibit_create.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Exhibit Date</th>
		                  <th>Exhibit Time</th>
		                  <th>Exhibit Location</th>
		                  <th>Artists</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM Exhibits1 ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['exhibit_date'] . '</td>';
							   	echo '<td>'. $row['exhibit_time'] . '</td>';
							   	echo '<td>'. $row['exhibit_location'] . '</td>';
							   	echo '<td>'. $row['exhibit_artists'] . '</td>';
								echo '<td width=250>';
							   	echo '<a class="btn" href="exhibit_read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="exhibit_update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="exhibit_delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
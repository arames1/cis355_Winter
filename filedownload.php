<?php

//Connect to the database
$con = mysql_connect('localhost','arames1', 'aaaaa') 
or die (mysql_error());

$db = mysql_select_db('arames1',$con);

	//$id is the value of the id field in the table that contains the uploaded file
	
	
	if (isset($_POST['img_id'])) $id = $_POST['img_id']
	else $id = 1; //initialize the value to something
	
	
	//Create the query and get all info from gpc_upload file
	$query = "SELECT id, name, size, type FROM gpc_upload";
	$result = mysql_query($query);
	
	//display list
	while ($row = mysql_fetch_assoc($result)) {
		
		echo "<p>" . $row['id'] . " " . $row['name'] . " " . $row['size'] . " " . $row['type'] . "</p>";
	}
	
	echo "<form method ='post' action='filedownload.php'";
	echo "<br/> Hey, type an image id number<br/>";
	echo "<input type='text' name='img_id' />";
	echo "<inpute type='submit' value='Submit' />";
	echo "</form>"
	
	$query = "SELECT id, name, size, type, content FROM gpc_upload WHERE id = $id";
	
	$result = mysql_query($query);
	
	$content = mysql_result($result, 0, "content");
	echo "<img height='auto' width='50%' 
	src='data:image/jpeg;base64," . base64_encode($content) . "'>";
	
	show_source(__FILE__);
?>
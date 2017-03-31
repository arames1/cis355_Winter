<?php

//print_r($_FILES);
//exit();

ini_set('file-uploads',true);

if($_FILES['file1']['size'] > 0 &&
 $_FILES['file1']['size'] < 2000000){
	
	//Create variables for $_FILES elements on page
	$filename = $_FILES['file1']['name'];
	$tempname = $_FILES['file1']['tmp_name'];
	$filesize = $_FILES['file1']['size'];
	$filetype = $_FILES['file1']['type'];
	
	$filetype = (get_magic_quotes_gpc() == 0)
	? mysql_real_escape_string($filetype)
	. mysql_real_escape_string(stripslashes($_FILES['file1'])));

	$fp = fopen($tempname, 'r');
	$content = fread($fp, filesize($tempname));
	$content = addslashes($content);

	echo 'filename: ' . $filename . '<br/>';
	echo 'filesize: ' . $filesize . '<br/>';
	echo 'filetype: ' . $filetype . '<br/>';

	//Close the file
	fclose($fp);
	
	if(!get_magic_quotes_gpc()){
		$filename = addslashes ($filename);
	}
	
	
}

?>
<?php
session_start(); //required for every php file for application
//if userid is not set then call login screen
if (empty$_SESSION['userid'])){ //user not set
	login();
	exit();
}

//enables user to login
function login(){
	echo '<form action="demo_form.php" method="post">';
	echo '<p>Username (email):';
	echo '<input type="text" name="email"><br>';
	echo '<p>Password:';
	echo '<input type="password" name="password"><br>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';

	
}

include 'database.php';
include 'arts.php';
arts::displayListScreen();
?>
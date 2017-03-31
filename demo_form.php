<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = md5($password);
$loginApproved = false;


//find record with email address

include 'database.php';
$pdo = Database::connect();
		$sql = 'SELECT * FROM customers355 WHERE email = "' . $email . '"';
		foreach ($pdo->query($sql) as $row) {
			if (0 == strcmp(trim($row['password']), trim($password_hash))){	
			$loginApproved = true;
			$_SESSION['userid'] = $row['id'];
			}

		}
		Database::disconnect();
		//echo $_SESSION['userid'];
		//echo $_POST['email'];
		//echo $_POST['password'];
//confirm the password equals the password in the database

echo $email;
exit();

header("Location: oo.php");

?>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (!isset($_SESSION['user_nick'])) {
	echo" <meta http-equiv=refresh content='2; url=reg.php'><h1>Register, please...</h1>";
	exit;
	}
    else {
echo"
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Adding news form</title>
<link rel='stylesheet' type='text/css' href='style.css'/>
</head>
<body>
<h2> Add news</h2><br><hr>
<form name='pass' method='post' action='addn.php' >
Title<br>
<input type='text' name='title'value=Enter><br><br>
Text<br>
<textarea name='text' class=textarea-n>Enter your text</textarea><br>
<input type='submit' value='Add'>
</form>
<hr>
</body>
</html>";
}
?>
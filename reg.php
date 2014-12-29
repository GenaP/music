<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
echo"
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Register form</title>
</head>
<body>
<form name='pass' method='post' action='r.php' >
Login<br>
<input type='text' name='login'><br><br>
Password<br>
<input type='password' name='pasw1'><br><br>
Confirm password<br>
<input type='password' name='pasw2'><br><br>
Email<br>
<input type='text' name='email'><br><br>
<input type='submit' value='Register'>
</form>
<hr>
</body>
</html>";
?>

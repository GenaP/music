<?php 
session_start();
include "mysql_connect.php";
$login=$_REQUEST['login'];
$pasw=$_REQUEST['pasw'];
if ((empty($login)) || (empty($pasw))) {
	die("Empty field");
} 
if (preg_match("/[^0-9a-zA-Z_]/",$login)) {
echo"Wrong login";
exit;}
if (preg_match("/[^0-9a-zA-Z_+\[\\]]/",$pasw)) {
echo"Wrong password";
exit;}
try {
$stmt = $db->prepare('INSERT INTO users (login,password) VALUES (:login, :pasw)');
$stmt->execute(array(':login' => $login, ':pasw' => $pasw));
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='10; url=index.php'><center><h1><br><br><br><br>Registering process is succefully. Please use your login and password for 
autorization on site...</h1></center>";
?>

<?php 
session_start();
include "mysql_connect.php";
$login=$_REQUEST['login'];
$pasw=$_REQUEST['pasw'];
if ($login == NULL) 
{
	echo"<meta http-equiv=refresh content='2; url=index.php'> <center><h1>Empty login</h1></center>";
	exit();
	}
if ($pasw == NULL)
{
	echo"<meta http-equiv=refresh content='2; url=index.php'> <center><h1>Empty password</h1></center>";
	exit();
}
$login=trim($login);
$pasw=trim($pasw);    
try {
	$prepare=$db->prepare ("SELECT * FROM `users` WHERE `login` =:login AND `password` =:password");
	$prepare->execute(array(':login' => $login, ':password' => $pasw));
	$rows=$prepare->fetch(PDO::FETCH_OBJ);
	if((empty($rows->login)) || (empty($rows->password))) {
  echo "<meta http-equiv=refresh content='1; url=index.php'> <center><h1><br><br><br><br>Login failed...</h1></center>";
  exit;}
$_SESSION['user_id']=$rows->id;
$_SESSION['user_nick']=$rows->login;
$_SESSION['user_status']=$rows->status;
echo $rows->status;
}
catch(Exception $e) {
	print $e->getMessage();
}
$date=date("d-m-Y");
try {
$stmt = $db->prepare("UPDATE `test`.`users` SET `last_date` = '$date' WHERE `users`.`login`='$login'");
$stmt->execute();
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='1; url=index.php'> <center><h1><br><br><br><br>Login
is complete...</h1></center>";
?>

<?php 
session_start();
include "mysql_connect.php";
$login=$_REQUEST['login'];
$pasw1=$_REQUEST['pasw1'];
$pasw2=$_REQUEST['pasw2'];
$email=$_REQUEST['email'];
$reg_date=date("d-m-Y");
$status='user';
$avatar='/img/noavatar.jpg';

if ((empty($login)) || (empty($pasw1)) || (empty($pasw2)) || (empty($email))) {
	die("Empty field");
} 
if (preg_match("/[^0-9a-zA-Z_]/",$login)) {
echo"Wrong login";
exit;}
if (preg_match("/[^0-9a-zA-Z_+<>.,\[\\]]/",$pasw1)) {
echo"Wrong password";
exit;}
if ($pasw1!=$pasw2) {
	echo "Password don't confirmed";
	exit;
	}
try {
$prepare= $db->prepare("SELECT * FROM users WHERE `login`=:login");
$prepare->execute(array(':login'=>$login));
$rows=$prepare->fetch(PDO::FETCH_OBJ);
if (!empty($rows->login)==$login) {
	die("Login exist's");
}
}
catch (Exception $e) {
	print $e->getMessage();
}
try
{
$prepare= $db->prepare("SELECT * FROM users WHERE `email`=:email");
$prepare->execute(array(':email'=>$email));
$rows=$prepare->fetch(PDO::FETCH_OBJ);
if (!empty($rows->email)==$email) {
	die("Email exist's");
	}
}
catch (Exception $e) {
	print $e->getMessage();
}
try {
$stmt = $db->prepare('INSERT INTO users (login,password,email,status,avatar,reg_date) VALUES (:login, :pasw, :email, :status, :avatar, :reg_date)');
$stmt->execute(array(':login' => $login, ':pasw' => $pasw1, ':email'=>$email, ':status'=>$status, ':avatar'=>$avatar, ':reg_date'=>$reg_date));
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='2; url=index.php'><center><h1><br><br><br><br>Registering process is succefully. Please use your login and password for 
autorization on site...</h1></center>";
?>

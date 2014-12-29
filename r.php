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
	echo $login, $email;
try {
$prepare = $db->prepare('SELECT * FROM users WHERE `login`=:login AND `email`=:email');
$prepare->execute(array(':login'=>$login, ':email'=>$email));
$rows=$prepare->fetch(PDO::FETCH_OBJ);	
	if ($rows->login != "") {
		echo "<meta http-equiv=refresh content='1; url=index.php'> <center><h1><br><br><br><br>Login exist's...</h1></center>";
		exit;
	}
	if ($rows->email != "") {
		echo "<meta http-equiv=refresh content='1; url=index.php'> <center><h1><br><br><br><br>Email exist's...</h1></center>";
		exit;
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
echo "<meta http-equiv=refresh content='100; url=index.php'><center><h1><br><br><br><br>Registering process is succefully. Please use your login and password for 
autorization on site...</h1></center>";
?>

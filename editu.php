<?php 
session_start();
include "mysql_connect.php";
$login_c=$_REQUEST['login'];
$name=$_REQUEST['name'];
$surname=$_REQUEST['surname'];
$email=$_REQUEST['email'];
$id=$_REQUEST['id'];
$real_status=$_SESSION['user_status'];
if ($real_status!='admin') {
	$status_c=$_SESSION['user_status'];
	}
	else {
	$status_c=implode($_REQUEST['status']);
	}
try{
	$stmt = $db->prepare("UPDATE `test`.`users` SET `login` = '$login_c',
`name` = '$name', `surname` = '$surname', `status` = '$status_c' WHERE `users`.`id` =$id;");
$stmt->execute();
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='100; url=profile.php?member=$login_c'> <h1>Edit complete.</h1>";
?>

<?php
session_start();
include "mysql_connect.php";
$eng_title=$_REQUEST['eng_title'];
$eng_text=$_REQUEST['eng_text'];
$ukr_title=$_REQUEST['ukr_title'];
$ukr_text=$_REQUEST['ukr_text'];
$date=date("d-m-Y");
$author=$_SESSION['user_nick'];
try {
$stmt = $db->prepare('INSERT INTO news (`eng.title`,`eng.text`,`ukr.title`,`ukr.text`,`date`,`author`) VALUES (:eng_title, :eng_text, :ukr_title, :ukr_text, :date, :author)');
$stmt->execute(array(':eng_title' => $eng_title, ':eng_text' => $eng_text, ':ukr_title' => $ukr_title, ':ukr_text' => $ukr_text, ':date'=>$date, ':author'=>$author));
}
catch (Exception $e) {
	print $e->getMessage();
}
try{
$prepare = $db->prepare("SELECT `id` FROM news");
  	$prepare->execute();
  	$id=$db->lastInsertId();
  	}
  	catch(Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='100; url=index.php?id=$id'><h1>Insert complete.</h1>";
?>

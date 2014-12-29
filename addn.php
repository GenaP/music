<?php
session_start();
include "mysql_connect.php";
$title=$_REQUEST['title'];
$text=$_REQUEST['text'];
$date=date("d-m-Y");
$author=$_SESSION['user_nick'];
if ($title == "")
{
	echo '<meta http-equiv=refresh content="2; url=addnew.php><h1>Missing Title</h1>';
}
if ($text == "")
{
	echo '<meta http-equiv=refresh content="2; url=addnew.php><h1>Missing Text</h1>';
}
try {
$stmt = $db->prepare('INSERT INTO news (title,text,date,author) VALUES (:title, :text, :date, :author)');
$stmt->execute(array(':title' => $title, ':text' => $text, ':date'=>$date, ':author'=>$author));
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
echo "<meta http-equiv=refresh content='1; url=index.php?id=$id'><h1>Insert complete.</h1>";
?>

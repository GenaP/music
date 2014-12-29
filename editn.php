<?php
session_start();
include "mysql_connect.php";
$title=$_REQUEST['title'];
$text=$_REQUEST['text'];
$date=$_REQUEST['date'];
$id=$_REQUEST['id'];
if ($title == "")
{
	echo '<meta http-equiv=refresh content="2; url=addnew.php><h1>Missing Title</h1>';
}
if ($text == "")
{
	echo '<meta http-equiv=refresh content="2; url=addnew.php><h1>Missing Text</h1>';
}
try {
$stmt = $db->prepare("UPDATE `test`.`news` SET `title` = '$title',
`text` = '$text', `date` = '$date' WHERE `news`.`id` =$id;");
$stmt->execute();
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='1; url=index.php?id=$id'> <h1>Edit complete.</h1>";
?>

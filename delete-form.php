<?php
session_start();
include "mysql_connect.php";
if (!isset($_GET['id'])) {
	echo"<meta http-equiv=refresh content='1; url=index.php'>";
	}
	else
	{
		$id=$_GET['id'];
		try {
		$prepare=$db->prepare("DELETE FROM `test`.`news` WHERE `news`.`id` = $id");
		$prepare->execute();
		}
		catch(Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='1; url=index.php'><h2> Deleted </h2>";
}
?>		

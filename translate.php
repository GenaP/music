<?php
session_start();
include "mysql_connect.php";
$tr = !empty($_GET['tr']) ? $_GET['tr'] : NULL;
switch ($tr) {
	case 'ukr':
	$fp = file('ukr.php');
	echo '<form action="save.php" method="post">
	<textarea name="file">';
		foreach ($fp as $key => $value) {
			echo $value;
		}
		echo '</textarea><input type=hidden name=filename value="ukr.php"><INPUT TYPE="submit" value="Save"></form>';
		break;
	case 'eng':
	$fp = file('eng.php');
	echo '<form action="save.php" method="post"><textarea name=file>';
		foreach ($fp as $key => $value) {
			echo $value;
		}
		echo '</textarea><input type=hidden name=filename value="eng.php"><INPUT TYPE="submit" value="Save"></form>';
		break;	
	default:
		echo"error";
		break;
}
?>	


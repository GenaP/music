<?php
session_start();
include "mysql_connect.php";
$user=!empty($_SESSION['user_nick']) ? $_SESSION['user_nick']:NULL;
$status=!empty($_SESSION['user_status']) ? $_SESSION['user_status']:NULL;
if ($status!="admin" or $status=NULL) {
	echo"<meta http-equiv=refresh content='1; url=index.php'>";
	exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>Admin - users list</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
  </head>
  <body>
<h1>Admin - users list</h1> 
  <hr/>
  <div class="main">
  <div class="content">
<?php
{

try {	
  	$prepare = $db->prepare("SELECT * FROM users ORDER BY `login`");
  	$prepare->execute();
 	 while($rows = $prepare->fetch(PDO::FETCH_OBJ))
  	{
  		echo '<h3>'.$rows->login.'</h3>
  		Name: '.$rows->name.' '.$rows->surname.'<br/>
  		<a href="profile.php?member='.$rows->login.'">Go to profile page</a><br/>';
		echo' <hr/>';
  }
echo "<br/>";
}
catch(Exception $e) {
	print $e->getMessage();
}
}
?>
</div>
</div>
</body>
</html>

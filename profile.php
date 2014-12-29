<?php
session_start();
include "mysql_connect.php";
include "textFunc.php";
$member=$_GET['member'];
$user=!empty($_SESSION['user_nick']) ? $_SESSION['user_nick']:NULL;
try {
	$prepare=$db->prepare ("SELECT * FROM `users` WHERE `login` =:member");
	$prepare->execute(array(':member' => $member));
	$rows=$prepare->fetch(PDO::FETCH_OBJ);
	if(empty($rows->login)) {
  echo "<meta http-equiv=refresh content='1; url=index.php'> <center><h1><br><br><br><br>User don't exist...</h1></center>";
  exit;}
$member=$rows->login;
$banned=$rows->banned;
$cause=$rows->cause;
$email=$rows->email;
$status=$rows->status;
$name=$rows->name;
$surname=$rows->surname;
$avatar=$rows->avatar;
$reg_date=$rows->reg_date;
$last_date=$rows->last_date;
}
catch(Exception $e) {
	print $e->getMessage();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>Profile <?php echo $member; ?></title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
  </head>
  <body>
<h1>Profile page | <a href="index.php">Back to site</a> </h1> 
  <hr/>
<div class="main">
	<div class="user_content">
	   <div class="ava-block"><center><b><?php echo $member;?></b><?php if ($user==$member) {echo "(it's
	   you)";}?></center>
		<img src="<?php echo $avatar;?>"  alt="no avatar" class="ava"/>
	   </div><br/>
	   <div class="user_info"> Name: <?php echo "".$name." ".$surname."";?><br/>
	   			   Status: <?php echo $status;?><br/> 
	   			   Date of registration: <?php echo $reg_date; ?><br/>
	   			   E-mail: <?php echo $email;?><br/>
	   			   Last visit: <?php echo $last_date;?><br/>
</div><hr/><br/><h2><i>Articles of this user</i></h2><br/>
<?php
try {
	$query=$db->query("SELECT COUNT(*) as count FROM news");
	$row=$query->fetch();
	$count=$row['count'];
	$articles_per_page=7;
	$total_pages=intval(($count-1)/$articles_per_page)+1;
	$page2left='';
	$page1left='';
	$page1right='';
	$page2right='';
	$pervpage='';
	$nextpage='';
	$page=!empty($_GET['page']) ? $_GET['page'] : NULL;
	$page=intval($page);
	if (empty($page) or $page<0) $page=1;
	if ($page>$total_pages) $page=$total_pages;
	$start=$page*$articles_per_page-$articles_per_page;
	$prepare=$db->prepare ("SELECT * FROM `news` WHERE `author` =:member");
	$prepare->execute(array(':member' => $member));
	$output = array();
	while ($rows=$prepare->fetch(PDO::FETCH_OBJ)) {
		$output[$rows->id] = '<h3>'.$rows->title.'</h3>--------------------------------------<br/><br/>
	  		Created '.$rows->date.' by <a href="profile.php?member='.$rows->author.'">'.$rows->author.'</a><br/><br/>
			'.textFunc($rows->text,149).'... <br/><br/><a href="index.php?id='.$rows->id.'">Read more</a>';
			
		if (isset($_SESSION['user_nick']))  {
			$output[$rows->id] .= ' | <a href="edit-form.php?id='.$rows->id.'">Edit this article</a> | <a href="delete-form.php?id='.$rows->id.'">Delete this article</a><br/><br/>';}
			$output[$rows->id] .= ' <hr/><br/>';
		
	}
	
	if (!empty($output)) {
		print implode("\n", $output);
	}
	else {
		print "This author doesn't have any articles yet.";
	}
}
catch(Exception $e) {
	print $e->getMessage();
}

?>
  <br/>
  </div>
  </body>
</html> 

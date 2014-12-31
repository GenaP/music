<?php
session_start();
include "mysql_connect.php";
$user=!empty($_SESSION['user_nick']) ? $_SESSION['user_nick']:NULL;
$status=!empty($_SESSION['user_status']) ? $_SESSION['user_status']:NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>We are here to make some photo</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
  </head>
  <body>
<h1>We are here to make some noise!</h1> 
  <hr/>
  
  	<div class="main">
  	<?php
  if (empty($_SESSION['user_nick'])) {
 echo '
	<form name="log" method="post" action="login.php" class=log-in>Login<br/>
	  <input type="text" name="login"/><br/>Password<br/>
	  <input type="password" name="pasw"/><br/>
	  <input type="submit" value="Log in">
	</form>
	 ';
	 }
	else {
  echo '<div class=log-in>Hello, <a href="profile.php?member='.$_SESSION['user_nick'].'">'.$_SESSION['user_nick'].'</a>  |  |  <a href="logout.php">Logout</a></div>';
  }
  ?>
  	<div class="nav"><a href="index.php">Main page</a><br/><hr/>
  	<a href="reg.php" target="_blank">Register</a><hr/>
  	<a href="addnews.php" target="_blank">Add news</a><hr/>
  	<?php if ($status=='admin'){echo'<a href="users.php">User list</a>';}?>
  	</div>
  	<div class="content">
<?php
include "textFunc.php";
$id= !empty($_GET['id']) ? $_GET['id'] : NULL;
if (!isset ($id))
{

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
  	$prepare = $db->prepare("SELECT `id`, `title`, `text`, `date`, `author` FROM news ORDER BY `id` DESC LIMIT $start, $articles_per_page");
  	$prepare->execute();
 	 while($rows = $prepare->fetch(PDO::FETCH_OBJ))
  	{
  		echo '<h3>'.$rows->title.'</h3>--------------------------------------<br/><br/>
  		Created '.$rows->date.' by <a href="profile.php?member='.$rows->author.'">'.$rows->author.'</a><br/><br/>
		'.textFunc($rows->text,149).'... <br/><br/><a href="index.php?id='.$rows->id.'">Read more</a>';
		if ($rows->author==$user and $status=='editor' or $status=='admin') 
		echo' | <a href="edit-form.php?id='.$rows->id.'">Edit this article</a> | <a href="delete-form.php?id='.$rows->id.'">Delete this article</a><br/><br/>
		';
		echo' <hr/>';
  }
echo "<br/>";
if ($page != 1) $pervpage = '<a href= "index.php?page=1"><<</a>
                             <a href= "index.php?page='. ($page - 1) .'"><</a> '; 

if ($page != $total_pages) $nextpage = ' <a href= "index.php?page='. ($page + 1) .'">></a>
                                   <a href= "index.php?page=' .$total_pages. '"> >> </a>'; 
if($page - 2 > 0) $page2left = ' <a href= "index.php?page='. ($page - 2) .'">'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href= "index.php?page='. ($page - 1) .'">'. ($page - 1) .'</a> | ';
if($page + 2 <= $total_pages) $page2right = ' | <a href= "index.php?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
if($page + 1 <= $total_pages) $page1right = ' | <a href= "index.php?page='. ($page + 1) .'">'. ($page + 1) .'</a>'; 
print $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage.'<br/><br/>'; 
}

catch(Exception $e) {
	print $e->getMessage();
}
}
if (isset ($id))
{
try {
$prepare = $db->prepare("SELECT `id`, `title`, `text`, `date`, `author` FROM news WHERE `id` = :id ");
  $prepare->execute(array(':id' => $id));
  $rows = $prepare->fetch(PDO::FETCH_OBJ);
   if (($id) != ($rows->id)){
  echo "NoT ID";
  exit;}
  	echo'<h3>'.$rows->title.'</h3><br/> 
	Created:  '.$rows->date.' by '.$rows->author.'
	<hr/><br/>
	'.$rows->text.'
	<br/><br/>
	';
	}
	catch(Exception $e) {
	print $e->getMessage();
	}
}
?> </div>
  </div>
  </body>
</html>

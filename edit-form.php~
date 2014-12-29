<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Editing news form</title>
<link rel='stylesheet' type='text/css' href='style.css'/>
</head>
<body>
<h2> Add news</h2><br><hr>
<div class="content">
<?php
include "mysql_connect.php";
function textFunc( $str, $maxLen )
	{
	if ( mb_strlen( $str ) > $maxLen )
		{
		preg_match( '/^.{0,'.$maxLen.'} .*?/ui', $str, $match );
		return $match[0].' ';
		}
	else {
		return $str;
		}
	}
$id= !empty($_GET['id']) ? $_GET['id'] : NULL;
if (!isset ($id))
{

try {	
	$query=$db->query("SELECT COUNT(*) as count FROM news");
	$row=$query->fetch();
	$count=$row['count'];
	$articles_per_page=10;
	$total_pages=intval(($count-1)/$articles_per_page)+1;
	$page=!empty($_GET['page']) ? $_GET['page'] : NULL;
	$page=intval($page);
	if (empty($page) or $page<0) $page=1;
	if ($page>$total_pages) $page=$total_pages;
	$start=$page*$articles_per_page-$articles_per_page;
  	$prepare = $db->prepare("SELECT `id`, `title`, `text`, `date` FROM news LIMIT $start, $articles_per_page");
  	
  	$prepare->execute();
 	 while($rows = $prepare->fetch(PDO::FETCH_OBJ))
  	{
  		echo '<h3>'.$rows->title.'</h3><br>
		'.textFunc($rows->text,149).'... <br><br><a href="edit-form.php?id='.$rows->id.'">
		Edit this new</a><br>
		Created '.$rows->date.' by ...<br><hr><br>';
  }
echo "<hr color='white'<br><br>";
if ($page != 1) $pervpage = '<a href= ./edit-form.php?page=1><<</a>
                             <a href= ./edit-form.php?page='. ($page - 1) .'><</a> '; 
if ($page != $total_pages) $nextpage = ' <a href= ./edit-form?page='. ($page + 1) .'>></a>
                                   <a href= ./edit-form.php?page=' .$total_pages. '>>></a>'; 
if($page - 2 > 0) $page2left = ' <a href= ./edit-form.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href= ./edit-form.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
if($page + 2 <= $total_pages) $page2right = ' | <a href= ./edit-form.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total_pages) $page1right = ' | <a href= ./edit-form.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 
echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 
}

catch(Exception $e) {
	print $e->getMessage();
}
}
if (isset ($id))
{

try {
$prepare = $db->prepare("SELECT `id`, `title`, `text`, `date` FROM news WHERE `id` ='".$id."'");
  $prepare->execute();
  $rows = $prepare->fetch(PDO::FETCH_OBJ);
  if (($id) != ($rows->id)){
  echo "NoT ID";
  exit;
  } 
  	echo"<form name='pass' method='post' action='editn.php' >
  	<input type='hidden' name='id' value=$id>
  	<textarea name='title'>$rows->title </textarea><br/><br/>
	Created: <input type='text' name='date'value=$rows->date>
	<hr/><br/>
	<textarea name='text' class=textarea-n>
	$rows->text</textarea>
	<br/><br/>
	<input type=submit value=Edit>
	";
	}
	catch(Exception $e) {
	print $e->getMessage();
}
}
?>
</div>
 </body>
</html>

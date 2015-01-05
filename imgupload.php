<?php
session_start();
include "mysql_connect.php";
if (empty($_FILES['imgupload']['name']))
{
$avatar = "img/noavatar.jpg";
}
else
{
$path_directory = 'img/';
if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(png)|(PNG)$/',$_FILES['imgupload']['name']))
{ 
        $filename = $_FILES['imgupload']['name'];
        $source = $_FILES['imgupload']['tmp_name'];
        $target = $path_directory . $filename;
        move_uploaded_file($source, $target);
if(preg_match('/[.](PNG)|(png)$/', $filename)) {
    $im = imagecreatefrompng($path_directory.$filename) ;
    }  
if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
    $im = imagecreatefromjpeg($path_directory.$filename);
    }
$w=150;
$w_src=imagesx($im);
$h_src=imagesy($im);
$dest=imagecreatetruecolor($w, $w);
imagealphablending( $dest, false );
	if ($w_src>$h_src) {
		imagecopyresampled($dest, $im, 0, 0, round((max($w_src, $h_src)-min($w_src, $h_src))/2), 
		0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
		}
	if ($w_src>$h_src) {
		imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $h_src);
		}
$nick=$_SESSION['user_nick'];
imagejpeg($dest,$path_directory.$nick.".jpg");
$avatar=$path_directory.$nick.".jpg";
try{
	$stmt = $db->prepare("UPDATE `test`.`users` SET `avatar` = '$avatar' WHERE `users`.`login` ='$nick';");
$stmt->execute();
}
catch (Exception $e) {
	print $e->getMessage();
}
echo "<meta http-equiv=refresh content='1; url=profile.php?member=$nick'> <h1>Upload complete.</h1>";
$delfull=$path_directory.$filename;
unlink($delfull);
}
else
{
	exit("Wrong format file");
	}
}	
?>

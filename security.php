<?php 
session_start();
$content=file("conf/conf.txt");
$login=$_REQUEST['login'];
$pasw=$_REQUEST['pasw'];
if ($login == "") 
{
	echo"<meta http-equiv=refresh content='2; url=reg.php'> <center><h1>Íåçàïîâíåíî ïîëå \"Ëîã³í\"</h1></center>";
	exit();
	}
if ($pasw == "")
{
	echo"<meta http-equiv=refresh content='2; url=reg.php'> <center><h1>Íåçàïîâíåíî ïîëå \"Ïàðîëü\"</h1></center>";
	exit();
}
$login=trim($login);
$pasw=trim($pasw);    
$strpath="conf/conf.txt";
$f=fopen($strpath,"w");
fwrite($f,md5($login)."\r\n");
fwrite($f,md5($pasw)."\r\n");
fwrite($f,session_id());
echo "<meta http-equiv=refresh content='1; url=index.php'><center><h1><br><br><br><br>Registering process is succefully. Please use your login and password for 
autorization on site...</h1></center>";
?>
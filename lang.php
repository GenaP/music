<?php 
switch (!empty($_GET['lang']) ? $_GET['lang']:NULL):
  default : include "eng.php";
   $_SESSION['user_lang'] = 'eng';
   break;
  case "ukr" : include "ukr.php";
   $_SESSION['user_lang'] = 'ukr';
   break;
  case "eng" : include "eng.php";
  $_SESSION['user_lang'] = 'eng';
   break;
endswitch;
?>

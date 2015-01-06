<?php 
switch (!empty($_GET['lang']) ? $_GET['lang']:NULL):
  default : include "eng.php";
   $_SESSION['user_lang'] = 'eng';
   $user_lang = $_SESSION['user_lang'];
   break;
  case "ukr" : include "ukr.php";
   $_SESSION['user_lang'] = 'ukr';
   $user_lang = $_SESSION['user_lang'];
   break;
  case "eng" : include "eng.php";
  $_SESSION['user_lang'] = 'eng';
  $user_lang = $_SESSION['user_lang'];
   break;
endswitch;
?>

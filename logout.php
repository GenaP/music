<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_nick']);
unset($_SESSION['user_status']);
session_destroy();
echo"<meta http-equiv=refresh content='1; url=index.php'><center><h1>Logout complete</h1>";
?>

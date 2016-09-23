<?php
//continues current session
session_start();
//clears SESSION var
unset($_SESSION);
//ends Current Session
session_destroy();
//sends user back to home page
header('Location: index.php');
 ?>

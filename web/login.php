<?php
//continues session
session_start();
//pulls in external functions and vars
require_once("models/db.php");
require_once("models/users.php");
require_once("models/lists.php");
require_once("models/items.php");
require_once("views/functions.php");
//check if user is logged in
if (isset($_POST['userName']))
{
  $userName = $_POST['userName'];
  $pword = $_POST['password'];

  $results = getUserByUserName($db, $userName);
  $hashPass = $results['p4swrd'];

  if(password_verify($pword, $hashPass))
  {
    $_SESSION['userID'] = $results['userID'];
    $_SESSION['userName'] = $results['usrn4m'];
    $_SESSION['firstName'] = $results['firstName'];
    $_SESSION['lastName'] = $results['lastName'];
    $_SESSION['admin'] = $results['admin'];

    header('Location: index.php');
  }
}

include_once('views/header.php'); //inserts header info
include_once('views/login.php');
include_once('views/footer.php'); ?>

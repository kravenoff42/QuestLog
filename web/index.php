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
if (isset($_SESSION['userName']))
{
  $firstName = $_SESSION['firstName'];
  $admin = $_SESSION['admin'];
}
include_once('views/header.php');
include_once('views/landing.php');
include_once('views/footer.php'); ?>

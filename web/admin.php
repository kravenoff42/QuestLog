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
if (isset($_SESSION['userID']))
{
  //grabs user data from $_SESSION
  $userID = $_SESSION['userID'];
  $userName = $_SESSION['userName'];
  $firstName = $_SESSION['firstName'];
  $lastName = $_SESSION['lastName'];
  $admin = $_SESSION['admin'];
}
else
{
  //sends user back to home page in not logged in
  header('Location: index.php');
}

//check if user has pressed submit
if(isset($_POST['action']))
{
  //grab data from POST var
  $action = $_POST['action'];
  $currUserID = $_POST['userID'];
  $currUserName = $_POST['userName'];
  $currFirstName =$_POST['firstName'];
  $currLastName = $_POST['lastName'];
  $currEmail = $_POST['email'];
  $currAdmin = $_POST['admin'];
  $currPassword = $_POST['password'];
}

include_once('views/header.php');
include_once("views/adminHeader.php");

// checks if action has been selected
if (!empty($action))
{
  //check which action was chosen
  switch($action)
  {
    case "Add":
      addUser($db, $currFirstName, $currLastName, $currUserName, $currPassword, $currEmail, $currAdmin);
      break;
    case "Edit":
       //logic is in displayForm()
      break;
    case "Update":
      updateUser($db, $currUserID, $currFirstName, $currLastName, $currUserName, $currEmail, $currAdmin);
      unset($currUserID);//clears userID so that normal form is shown
      break;
    case "Delete":
      deleteUser($db, $currUserID);
      unset($currUserID);//clears userID so that normal form is shown
      break;
   }
}
displayUsers($db);
displayAdminForm($db, $currUserID, $userID);

include_once('views/tableclose.php');
include_once('views/footer.php'); ?>

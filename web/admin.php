<?php
//continues session
session_start();
//pulls in external functions and vars
require_once("models/db.php");
require_once("models/users.php");
require_once("models/lists.php");
require_once("models/items.php");
require_once("views/adminViews.php");
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
  if(isset($_POST['userID']))
  {
    $currUserID = $_POST['userID'];
  }
  if(isset($_POST['userName']))
  {
    $currUserName = $_POST['userName'];
    $currFirstName =$_POST['firstName'];
    $currLastName = $_POST['lastName'];
    $currEmail = $_POST['email'];
    $currAdmin = $_POST['admin'];
    if (isset($_POST['password']))
    {
      $currPassword = $_POST['password'];
    }
  }
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
       //logic is down below
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
if (!isset($currUserID))
{
  displayUserAddForm();
}
//fires off if the $currUserID var has a value
else
{
  //Update Form
  displayUserUpdateForm($db, $currUserID, $userID);
}

include_once('views/tableclose.php');
include_once('views/footer.php'); ?>

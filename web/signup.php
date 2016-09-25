<?php
//continues session
session_start();
//pulls in external functions and vars
require_once("models/db.php");
require_once("models/users.php");
require_once("models/lists.php");
require_once("models/items.php");

//check if user has pressed submit
$finished = false;
if (isset($_POST['password']))
{
  //grbs data from POST var
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $finished = insertNewUserAsUser($db, $firstName, $lastName, $email, $userName, $password);

}

include_once('views/header.php'); //inserts header info

if($finished)
{
  // If result matched $userName build link back to log in
  $confirmation = confirmUserCreation($db, $userName);
  if($confirmation['usrn4m']==$userName)
  {
    echo "<p class='signup-success'> User ".$confirmation['usrn4m'].", successfully created! Please <a href='login.php'>login</a> now.</p>";
  }
}
include_once('views/signupView.php');//inserts sign up form
include_once('views/footer.php'); //inserts footer info
?>

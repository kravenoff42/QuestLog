<?php
//continues session
session_start();
//pulls in external functions and vars
require_once("models/db.php");
require_once("models/users.php");
require_once("models/lists.php");
require_once("models/items.php");
require_once("views/functions.php");

//check if user has pressed submit
if (isset($_POST['p4swrd']))
{
  //grbs data from POST var
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $usrn4m = $_POST['usrn4m'];
  $p4swrd = $_POST['p4swrd'];
  $finished = insertNewUserAsUser($db, $firstName, $lastName, $email, $usrn4m, $p4swrd);

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
include_once('views/signup.php');//inserts sign up form
include_once('views/footer.php'); //inserts footer info
?>

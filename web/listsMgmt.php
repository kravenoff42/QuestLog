<?php
//continues session
session_start();
//pulls in external functions and vars
require_once("models/db.php");
require_once("models/users.php");
require_once("models/lists.php");
require_once("models/items.php");
require_once("views/listViews.php");
require_once("views/functions.php");
//check if user is logged in
if (isset($_SESSION['userID']))
{
  $userID = $_SESSION['userID'];
  $userName = $_SESSION['userName'];
  $firstName = $_SESSION['firstName'];
  $lastName = $_SESSION['lastName'];
  $admin = $_SESSION['admin'];
}
else
{
  header('Location: index.php');
}

/******grab data**********/
if(isset($_POST['action']))
{
  $action = $_POST['action'];
  if(isset($_POST['listID']))
  {
    $listID = $_POST['listID'];

  }
  if(isset($_POST['listName']))
  {
    $listName = $_POST['listName'];
  }
}


/******page logic**********/
if (isset($action))
{
  switch($action)
  {
    case "Add":
      addList($db, $listName, $userID);
      break;
    case "Edit":
       //logic is in displayForm
      break;
    case "Update":
      updateList($db, $listID, $listName);
      unset($listID);
      break;
    case "Delete":
      deleteList($db, $listID);
      unset($listID);
   }
}
include_once('views/header.php');
echo "<a href='itemsViewer.php' >< Back to Lists</a><br/><br/>";
displayLists($db, $userID);
if (empty($listID))
{
  //Add Form
  displayListAddForm();
}
else
{
  //Update Form
  displayListUpdateForm($db, $listID);
}
include_once('views/footer.php');
?>

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
$listID = 1;
if(isset($_POST['listID']))
{
$action = $_POST['action'];
$itemID = $_POST['itemID'];
$itemText = $_POST['itemText'];
$listID = $_POST['listID'];
$dueDate = $_POST['dueDate'];
$dueTime = $_POST['dueTime'];
}
include_once('views/header.php');
include_once('views/itemsHeader.php');

/******page logic*********/
if (!empty($action))
{
  switch($action)
  {
    case "Add":
      addItem($db, $listID, $itemText, $dueDate, $dueTime);
      break;
    case "Edit":
       //logic is in displayForm
      break;
    case "Update":
      updateItemText($db, $itemID, $itemText, $dueDate, $dueTime);
      unset($itemID);
      $action="Add";
      break;
    case "Undone":
    case "Done":
      updateItemStatus($db, $itemID, $action);
      unset($itemID);
      $action="Add";
      break;
    case "Delete":
      deleteItem($db, $itemID);
      unset($itemID);
      break;
   }
}

displayItems($db, $listID);
displayItemsForm($db, $listID, $itemID);

include_once('views/tableclose.php');
include_once('views/footer.php') ?>

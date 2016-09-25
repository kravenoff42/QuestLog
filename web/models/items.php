<?php
/*******deletes data from items table**********/
function deleteItem($db, $itemID)
{
  try {
    $stmt = $db->prepare("DELETE FROM items WHERE itemID = :itemID");
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Could not delete Item.");
  }
}

/*******updates text for specified item**********/
function updateItemText($db, $itemID, $itemText, $dueDate, $dueTime)
{
  try {
    $stmt = $db->prepare("UPDATE items SET itemText = :itemText , dueDate = :dueDate, dueTime = :dueTime WHERE itemID = :itemID");
    $stmt->bindParam(':itemText', $itemText, PDO::PARAM_STR);
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    $stmt->bindParam(':dueDate', $dueDate);
    $stmt->bindParam(':dueTime', $dueTime);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Could not Update Item: $itemText");
  }
}
/*******updates status for specified item**********/
function updateItemStatus($db, $itemID, $action)
{
  if ($action=="Done")
    {$status=0;}
  elseif ($action=="Undone")
    {$status=1;}
  try {
    $stmt = $db->prepare("UPDATE items SET status = :status WHERE itemID = :itemID");
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Could not Update Item: $itemID");
  }
}
/*******inserts data into items table**********/
function addItem($db, $listID, $itemText, $dueDate, $dueTime)
{
  if($itemText!="")
  {
    try
    {
      $stmt = $db->prepare("INSERT INTO items ( listID, itemText, dueDate, dueTime) VALUES (:listID, :itemText, :dueDate, :dueTime)");
      $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
      $stmt->bindParam(':itemText', $itemText, PDO::PARAM_STR);
      $stmt->bindParam(':dueDate', $dueDate);
      $stmt->bindParam(':dueTime', $dueTime);
      $stmt->execute();
    }
    catch (PDOException $e)
    {
      die("Could not add Item: $itemText");
    }
  }
}
function getItemsByListID($db, $listID)
{
  try {
    $stmt = $db->prepare("SELECT * FROM items WHERE listID = :listID");
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;

  } catch (Exception $e) {
    die("Could not find items for this list.");
  }
}
function getItemsByItemID($db, $itemID)
{
  try
  {
    $stmt = $db->prepare("SELECT * FROM items WHERE itemID = :itemID");
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    $stmt->execute();
  }
  catch (PDOException $e)
  {
    die("Could not find data for $listID.");
  }
}
 ?>

<?php

function updateList($db, $listID, $listName)
{
  try
  {
    $stmt = $db->prepare("UPDATE lists SET listName = :listName WHERE listID = :listID");
    $stmt->bindParam(':listName', $listName, PDO::PARAM_STR);
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();
  }
  catch (PDOException $e)
  {
    die("Could not Update List: $listName\n$e");
  }
}

function deleteList($db, $listID)
{
  try
  {
    $stmt = $db->prepare("DELETE FROM lists WHERE listID = :listID");
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();
  }
  catch (PDOException $e)
  {
    die("Could not delete List.");
  }
}

function addList($db, $listName, $userID)
{
  if($listName!="")
  {
    try
    {
      $stmt = $db->prepare("INSERT INTO lists (listName, userID) VALUES (:listName, :userID)");
      $stmt->bindParam(':listName', $listName, PDO::PARAM_STR);
      $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $stmt->execute();
    }
    catch (PDOException $e)
    {
      die("Could not add List: $listName\n$e");
    }
  }
}

function getListsByUserID($db, $userID)
{
  try
  {
    $stmt = $db->prepare("SELECT * FROM lists WHERE userID = :userID");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
  }
  catch (PDOException $e)
  {
    die("Could not find lists for user: $userID.");
  }
}
function getListNameByID($db, $listID)
{
  try {
    $stmt = $db->prepare("SELECT listName FROM lists WHERE listID = :listID");
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();

    $list = $stmt->fetch();
    return $list['listName'];
  }
  catch (PDOException $e)
  {
    die("Could not find List name for ID: $listID");
  }



}
function getListByListID($db, $listID)
{
  try
  {
    $stmt = $db->prepare("SELECT * FROM lists WHERE listID = :listID");
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch (PDOException $e)
  {
    die("Could not find info on list #$listID");
  }
}


?>

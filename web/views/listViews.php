<?php
function displayLists($db, $userID)
{
  try
  {
    $lists = getListsByUserID($db, $userID);
    echo "<table>";
    while ($list = $lists->fetch(PDO::FETCH_ASSOC) )
    {
      echo "\n\t<tr>";
      echo "\n\t\t<td>";
      echo $list['listName'];
      echo "\n\t\t<td>";
        echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
          echo "\n\t\t\t<input type='hidden' name='listName' value='".$list['listName']."'/>";
          echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
          echo "\n\t\t\t<input type='hidden' name='action' value='Edit'/>";
          echo "\n\t\t\t<button type='submit' class='edit' ><i class='material-icons'>edit</i></button>";
        echo "</form>";
      echo "\n\t\t</td>";
      echo "\n\t\t<td>";
        echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
          echo "\n\t\t\t<input type='hidden' name='listName' value='".$list['listName']."'/>";
          echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
          echo "\n\t\t\t<input type='hidden' name='action' value='Delete'/>";
          echo "\n\t\t\t<button type='submit' class='delete'><i class='material-icons'>delete</i></button>";
        echo "</form>";
      echo "\n\t\t</td>";
    echo "\n\t</tr>";
    }
    echo "</table>";
  }
  catch (PDOException $e)
  {
    die("Cannot display your lists.");
  }
}
function displayListAddForm()
{
  echo "\n<div>";
  echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
  echo "\n\t\t<input type='text' name='listName'/>";
  echo "\n\t\t\t<input type='hidden' name='action' value='Add'/>";
  echo "\n\t\t\t<button type='submit' class='add'><i class='material-icons'>add</i></button>";
  echo "\n\t</form>";
  echo "\n</div>";
}
function displayListUpdateForm($db, $listID)
{
  $list = getListByListID($db, $listID);
  
  echo "\n<div>";
  echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
  echo "\n\t\t<input type='text' name='listName' value='".$list['listName']."'/>";
  echo "\n\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
  echo "\n\t\t<input type='hidden' name='action' value='Update'/>";
  echo "\n\t\t<button type='submit' class='update'><i class='material-icons'>refresh</i></button>";
  echo "\n\t</form>";
  echo "\n</div>";
}
 ?>

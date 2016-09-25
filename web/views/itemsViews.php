<?php
function displayItems($listItems)
{
  while ($list = $listItems->fetch(PDO::FETCH_ASSOC) )
  {

    if ($list['status']==0)
      {$status = 'Undone';
      $class = '';}
    else
      {$status = 'Done';
      $class = 'done';}
      echo "\n\t<tr>";
        echo "\n\t\t<td>";
          echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
            echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='action' value='$status'/>";
            echo "\n\t\t\t<button type='submit'  class='$status'><i class='material-icons'>check</i></button>";
          echo "</form>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "<span class='$class'>";
            echo $list['itemText'];
          echo "</span>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        if($list['dueDate']!="0000-00-00")
          {echo "\n\t\t\t<input type='date' name='dueDate' value='".$list['dueDate']."' disabled />";}
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
            echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='action' value='Edit'/>";
            echo "\n\t\t\t<button type='submit' class='edit' ><i class='material-icons'>edit</i></button>";
          echo "</form>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
            echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."'/>";
            echo "\n\t\t\t<input type='hidden' name='action' value='Delete'/>";
            echo "\n\t\t\t<button type='submit' class='delete'><i class='material-icons'>delete</i></button>";
          echo "</form>";
        echo "\n\t\t</td>";
      echo "\n\t</tr>";
  }
}
function displayUpdateForm($db, $itemID)
{
  $itemInfo = getItemsByItemID($db, $itemID);

  echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
  while ($item = $itemInfo->fetch(PDO::FETCH_ASSOC) )
  {
    echo "\n\t<tr>";
      echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='hidden' name='listID' value='".$item['listID']."' />";
        echo "\n\t\t\t<input type='hidden' name='itemID' value='".$item['itemID']."' />";
      echo "\n\t\t</td>";
      echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='text' name='itemText' value='".$item['itemText']."' />";
      echo "\n\t\t</td>";
      echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='date' name='dueDate' value='".$item['dueDate']."' />";
        echo "\n\t\t\t<input type='time' name='dueTime' value='".$item['dueTime']."' />";
      echo "\n\t\t</td>";
      echo "\n\t\t<td>";
      echo "\n\t\t\t<input type='hidden' name='action' value='Update'/>";
      echo "\n\t\t\t<button type='submit' class='update'><i class='material-icons'>refresh</i></button>";
      echo "\n\t\t</td>";
    echo "\n\t</tr>";
  echo "</form>";
  }
}
function displayAddForm($listID)
{
  echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
  echo "\n\t<tr>";


    echo "\n\t<td>";
      echo "\n\t\t\t<input type='hidden' name='listID' value='".$listID."' />";
    echo "\n\t\t</td>";
    echo "\n\t\t<td>";
      echo "\n\t\t\t<input type='text' name='itemText' />";
    echo "\n\t\t</td>";
    echo "\n\t\t<td>";
      echo "\n\t\t\t<input type='date' name='dueDate' />";
      echo "\n\t\t\t<input type='time' name='dueTime' />";
    echo "\n\t\t</td>";
    echo "\n\t\t<td>";
    echo "\n\t\t\t<input type='hidden' name='action' value='Add'/>";
    echo "\n\t\t\t<button type='submit' class='add'><i class='material-icons'>add</i></button>";
    echo "\n\t\t</td>";
  echo "\n\t</tr>";
  echo "</form>";
}
?>

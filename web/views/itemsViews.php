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

?>

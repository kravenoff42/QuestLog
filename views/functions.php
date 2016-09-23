<?php
/*********Display Welcome*****************/
function displayWelcome($firstName)
{
  //prints currentUsers first name

    echo "<span>";
      echo "Welcome, $firstName!";
    echo "</span>";

}

/*************builds item catalog*************/
function displayItems($db, $listID)
{
  try {
    $stmt = $db->prepare("SELECT * FROM items WHERE listID = :listID");
    $stmt->bindParam(':listID', $listID, PDO::PARAM_INT);
    $stmt->execute();

    while ($list = $stmt->fetch(PDO::FETCH_ASSOC) )
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
              echo "\n\t\t\t<input type='hidden' name='listID' value='$listID'/>";
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
              echo "\n\t\t\t<input type='hidden' name='listID' value='$listID'/>";
              echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."'/>";
              echo "\n\t\t\t<input type='hidden' name='action' value='Edit'/>";
              echo "\n\t\t\t<button type='submit' class='edit' ><i class='material-icons'>edit</i></button>";
            echo "</form>";
          echo "\n\t\t</td>";
          echo "\n\t\t<td>";
            echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
              echo "\n\t\t\t<input type='hidden' name='listID' value='$listID'/>";
              echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."'/>";
              echo "\n\t\t\t<input type='hidden' name='action' value='Delete'/>";
              echo "\n\t\t\t<button type='submit' class='delete'><i class='material-icons'>delete</i></button>";
            echo "</form>";
          echo "\n\t\t</td>";
        echo "\n\t</tr>";
    }
  } catch (Exception $e) {
    die("Could not find items for this list.");
  }
}
/*************builds text feilds*****************/
function displayItemsForm($db, $listID, $itemID)
{
  if (!isset($itemID))
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
  else
  {
    //Update Form
    echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";

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
    while ($list = $stmt->fetch(PDO::FETCH_ASSOC) )
    {
      echo "\n\t<tr>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='hidden' name='listID' value='".$list['listID']."' />";
          echo "\n\t\t\t<input type='hidden' name='itemID' value='".$list['itemID']."' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='itemText' value='".$list['itemText']."' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='date' name='dueDate' value='".$list['dueDate']."' />";
          echo "\n\t\t\t<input type='time' name='dueTime' value='".$list['dueTime']."' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='hidden' name='action' value='Update'/>";
        echo "\n\t\t\t<button type='submit' class='update'><i class='material-icons'>refresh</i></button>";
        echo "\n\t\t</td>";
      echo "\n\t</tr>";
    echo "</form>";
    }
  }
}

/*************builds drop menu***********/
function displayListsDropdown($db, $userID)
{
  $stmt = $db->prepare("SELECT * FROM lists WHERE userID = :userID");
  $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
  $stmt->execute();
  echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
    echo "<select name='listID'>";
      while ($list = $stmt->fetch(PDO::FETCH_ASSOC) )
      {
        echo "<option value='".$list['listID']."'>".$list['listName']."</option>\n\t";
      }
      echo "<input type='submit' />";
    echo "</select>";
  echo "</form>";
}

/******functions**********/
function displayLists($db, $userID)
{

  try
  {
    $stmt = $db->prepare("SELECT * FROM lists WHERE userID = :userID");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    echo "<table>";
    while ($list = $stmt->fetch(PDO::FETCH_ASSOC) )
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
function displayListsForm($db, $listID, $listName)
{
  if (empty($listID))
  {
    //Add Form
    echo "\n<div>";
    echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
    echo "\n\t\t<input type='text' name='listName'/>";
    echo "\n\t\t\t<input type='hidden' name='action' value='Add'/>";
    echo "\n\t\t\t<button type='submit' class='add'><i class='material-icons'>add</i></button>";
    echo "\n\t</form>";
    echo "\n</div>";
  }
  else
  {
    //Update Form
    echo "\n<div>";
    echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
    echo "\n\t\t<input type='text' name='listName' value='$listName'/>";
    echo "\n\t\t<input type='hidden' name='listID' value='$listID'/>";
    echo "\n\t\t<input type='hidden' name='action' value='Update'/>";
    echo "\n\t\t<button type='submit' class='update'><i class='material-icons'>refresh</i></button>";
    echo "\n\t</form>";
    echo "\n</div>";
  }

}


/*************builds user catalog*************/
function displayUsers($db)
{
  try {
    // grabs all users
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    //loops through each user
      while ($user = $stmt->fetch(PDO::FETCH_ASSOC) )
      {
        //converts int into words
        if ($user['admin']==0)
          {$adminWord = 'User';}
        else
          {$adminWord = 'Admin';}
          //builds table with user data
          echo "\n\t<tr>";
            echo "\n\t\t<td>";
              echo $user['userID'];
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
              echo $user['usrn4m'];
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
              echo $user['firstName'];
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
              echo $user['lastName'];
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
              echo $user['email'];
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
              echo $adminWord;
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
            //edit button
              echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
                echo "\n\t\t\t<input type='hidden' name='userID' value='".$user['userID']."'/>";
                echo "\n\t\t\t<input type='hidden' name='action' value='Edit'/>";
                echo "\n\t\t\t<button type='submit' class='edit' ><i class='material-icons'>edit</i></button>";//uses material icon
              echo "</form>";
            echo "\n\t\t</td>";
            echo "\n\t\t<td>";
            //delete button
              echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
                echo "\n\t\t\t<input type='hidden' name='userID' value='".$user['userID']."'/>";
                echo "\n\t\t\t<input type='hidden' name='action' value='Delete'/>";
                echo "\n\t\t\t<button type='submit' class='delete'><i class='material-icons'>delete</i></button>";//uses material icon
              echo "</form>";
            echo "\n\t\t</td>";
          echo "\n\t</tr>";

      }
    }
    catch (Exception $e)
    {
    die("Could not find users.");
  }
}

/*************builds text feilds*****************/
function displayAdminForm($db, $currUserID, $userID)
{
  if (!isset($currUserID))
  {
    //generate $defaultPass
    $defaultPass = "QuestLog".rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    //build form for adding new user
    echo "<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
      echo "\n\t<tr>";
        echo "\n\t\t<td>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='userName' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='firstName' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='lastName' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='email' name='email' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='number' name='admin' min='0' max='1' value='0'/>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='hidden' name='action' value='Add'/>";
        echo "\n\t\t\t<button type='submit' class='add'><i class='material-icons'>add</i></button>";
        echo "\n\t\t</td>";
      echo "\n\t</tr>";
      echo "\n\t<tr>";
        echo "\n\t\t<td>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<p>Password:</p>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='password'  value='".$defaultPass."'/>";
        echo "\n\t\t</td>";
      echo "\n\t</tr>";
    echo "</form>";
  }
  //fires off if the $currUserID var has a value
  else
  {
    //Update Form
    echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";

    $stmt = $db->prepare("SELECT * FROM users WHERE userID = :userID");
    $stmt->bindParam(':userID', $currUserID, PDO::PARAM_INT);
    $stmt->execute();
    //loops through use data
    while ($user = $stmt->fetch(PDO::FETCH_ASSOC) )
    {
      echo "\n\t<tr>";
        echo "\n\t<td>";
          echo "\n\t\t\t<input type='hidden' name='userID' value='".$user['userID']."' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='userName'  value='".$user['usrn4m']."' />";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='firstName'  value='".$user['firstName']."'/>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='text' name='lastName'  value='".$user['lastName']."'/>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='email' name='email'  value='".$user['email']."'/>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
          echo "\n\t\t\t<input type='number' name='admin' min='0' max='1' value='".$user['admin']."'";
          //lockes admin level if user matches logged in user
          if ($currUserID==$userID){echo " class='disabled' ";}
          echo "/>";
        echo "\n\t\t</td>";
        echo "\n\t\t<td>";
        echo "\n\t\t\t<input type='hidden' name='action' value='Update'/>";
        echo "\n\t\t\t<button type='submit' class='update'><i class='material-icons'>refresh</i></button>";
        echo "\n\t\t</td>";
      echo "\n\t</tr>";
      echo "</form>";
    }
  }
}

 ?>

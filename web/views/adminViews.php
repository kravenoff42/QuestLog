<?php
/*************builds user catalog*************/
function displayUsers($db)
{
    // grabs all users
  $allUsers = getAllUserInfo($db);
    //loops through each user
    while ($user = $allUsers->fetch(PDO::FETCH_ASSOC) )
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

function displayUserUpdateForm($db, $currUserID, $userID)
{
  $userInfo = getUserByID($db, $currUserID);
  echo "\n\t<form action='".$_SERVER['SCRIPT_NAME']."' method='post'>";
  //loops through use data
  while ($user = $userInfo->fetch(PDO::FETCH_ASSOC) )
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
function displayUserAddForm()
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
 ?>

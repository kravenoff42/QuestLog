<?php
function getUserByUserName($db, $userName)
{
  try
  {
    $stmt = $db->prepare("SELECT * FROM users WHERE usrn4m = :username");
    $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetch();

    return $results;

  } catch (PDOException $e)
  {
    die("User $userName, does not exist.");
  }

}
function insertNewUserAsUser($db, $firstName, $lastName, $email, $userName, $p4swrd)
{
  try
  {
    //hashes entered password
    $hashPass = password_hash($p4swrd, PASSWORD_DEFAULT);
    //inserts new user into system
    $stmt = $db->prepare("INSERT INTO users SET firstName = :firstName, lastName = :lastName, email = :email, usrn4m = :usrn4m, p4swrd = :p4swrd");
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':usrn4m', $userName, PDO::PARAM_STR);
    $stmt->bindParam(':p4swrd', $hashPass, PDO::PARAM_STR);//binds Password to hashed pass
    $stmt->execute();
    return true;
  }
  catch (PDOException $e)
  {
    //returns failure message
    die("Could not create account for $userName");
  }
}

function confirmUserCreation($db, $userName)
{
  try
  {
    //checks database for users info
    $stmt = $db->prepare("SELECT usrn4m FROM users WHERE usrn4m = :username");
    $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetch();
    return $results;
  }
  catch (PDOException $e)
  {
    //returns failure message
    die("Could not find user $userName.");
  }
}

/*******deletes data from users table**********/
function deleteUser($db, $currUserID)
{
  try {
    $stmt = $db->prepare("DELETE FROM users WHERE userID = :userID");
    $stmt->bindParam(':userID', $currUserID, PDO::PARAM_INT);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Could not delete User.");
  }
}

/*******updates text for specified user**********/
function updateUser($db, $currUserID, $currFirstName, $currLastName, $currUserName, $currEmail, $currAdmin)
{
  try {
    $stmt = $db->prepare("UPDATE users SET usrn4m = :userName , firstName = :firstName, lastName = :lastName, email = :email, admin = :admin WHERE userID = :userID");
    $stmt->bindParam(':userID', $currUserID, PDO::PARAM_INT);
    $stmt->bindParam(':firstName', $currFirstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $currLastName, PDO::PARAM_STR);
    $stmt->bindParam(':userName', $currUserName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $currEmail, PDO::PARAM_STR);
    $stmt->bindParam(':admin', $currAdmin, PDO::PARAM_INT);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Could not Update User: $currUserName");
  }
}
/*******inserts data into users table**********/
function addUser($db, $currFirstName, $currLastName, $currUserName, $currPassword, $currEmail, $currAdmin)
{
  //hash the Password
  $hashPass = password_hash($currPassword, PASSWORD_DEFAULT);
  //check to confirm that vars have values
  if($currUserName!="")
  {
    try
    {
      $stmt = $db->prepare("INSERT INTO users ( firstName, lastName, usrn4m, p4swrd, email, admin) VALUES ( :firstName, :lastName, :usrn4m, :p4swrd, :email, :admin)");
      $stmt->bindParam(':firstName', $currFirstName, PDO::PARAM_STR);
      $stmt->bindParam(':lastName', $currLastName, PDO::PARAM_STR);
      $stmt->bindParam(':usrn4m', $currUserName, PDO::PARAM_STR);
      $stmt->bindParam(':p4swrd', $hashPass, PDO::PARAM_STR); //bind to hashed pass
      $stmt->bindParam(':email', $currEmail, PDO::PARAM_STR);
      $stmt->bindParam(':admin', $currAdmin, PDO::PARAM_STR);
      $stmt->execute();
      //returns success message
      echo "<div class='signup-success'>";
      echo "<p>Email:$currEmail <br/> Username:$currUserName <br/> Password: $currPassword <br/><br/> Please copy and paste user info to send invite.</p>";
      echo "</div>";

    }
    catch (PDOException $e)
    {
      //returns failure message
      die("Could not add User: $currUserName");
    }
  }
}
function getUserByID($db, $currUserID)
{
  try
  {
    //gets info from that userID
    $stmt = $db->prepare("SELECT * FROM users WHERE userID = :userID");
    $stmt->bindParam(':userID', $currUserID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
  }
  catch (PDOException $e)
  {
    //returns failure message
    die("Could not find data for $currUserID.");
  }
}
function getAllUserInfo($db)
{
  try
  {
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt;
  }
  catch (PDOException $e)
  {
    die("Could not find Users.");
  }


}
 ?>

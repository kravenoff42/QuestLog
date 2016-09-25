<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" type="text/css">
    <title>QuestLog</title>
  </head>
  <body>
    <div class="header">
      <nav class="navbar">
        <ul>
          <?php
          ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="itemsViewer.php">My Lists</a></li>
          <?php
          if(isset($_SESSION['userName']))
          {
            echo'<li><a href="logout.php">Logout</a></li>';
            if($_SESSION['admin']==1)
            {
              echo'<li><a href="admin.php">Admin</a></li>';
            }
            if(isset($_SESSION['userName']))
            {
                echo "<p>Welcome, $firstName!</p>";
            }
          }
          else
          {
            echo'<li><a href="signup.php">Sign Up</a></li>';
            echo'<li><a href="login.php">Login</a></li>';
          }

          ?>
        </ul>
      </nav>
    </div>
    <div id="content">

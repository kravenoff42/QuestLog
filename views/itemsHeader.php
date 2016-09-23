<?php
echo "<div>\n";
  displayListsDropdown($db, $userID);
  echo "<a href='listsMgmt.php'>Edit Lists</a>";
echo "\n</div>";
$pageTitle = getListNameByID($db, $listID);
echo "<h1>$pageTitle</h1>";
?>

<table>
  <tbody>

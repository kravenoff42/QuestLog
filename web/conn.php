<?php
$username ="exam";
$password = "summer16";
$dsn = "mysql:host=ict.neit.edu;dbname=world_x";
try
{
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
  die("Oops, Can't find Database! --".$e->getMessage());
}
?>

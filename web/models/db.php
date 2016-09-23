<?php
$username ="sitesender";
$password = "IcnCcnoDarnisg1";
$dsn = "mysql:host=localhost;dbname=questlog";
try
{
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
  die("Oops, Can't find Database!");
}
?>

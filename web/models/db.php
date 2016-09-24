<?php
$username ="sql9137263";
$password = "VqR4Uxivjp";
$dsn = "mysql:host=sql9.freemysqlhosting.net;dbname=sql9137263";
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

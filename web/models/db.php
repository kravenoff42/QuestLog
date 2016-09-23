<?php
$username ="bpbpgypkfsjbte";
$password = "t1ygXm4Sd34IfC8e9R450w6jWV";
$dsn = "postgres:host=ec2-23-23-226-41.compute-1.amazonaws.com;dbname=d60umun7c5mdfn";
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

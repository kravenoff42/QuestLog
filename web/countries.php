<?php
require_once('conn.php');

$cityName = "Barcelona";

  try
  {
    $stmt = $db->prepare("SELECT * FROM city");

    //$stmt = $db->prepare("SELECT country.Name AS 'cntName', Code AS 'cntCode', District FROM country JOIN city ON CountryCode = Code WHERE city.Name = :cityName");
    //$stmt->bindParam(':cityName', $cityName, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);

echo $results;

  } catch (PDOException $e)
  {
    die("could not find any country with $cityName as a city.");
  }



while ($counrty = $results->fetch())
{
//	echo "Search Results: <br/>";
  echo $country['Name'];
//	//echo $country['cntName'].", ".$country['cntCode'].", ".$country['District']."<br/>";
}

?>

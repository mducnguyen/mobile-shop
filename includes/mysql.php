<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db = "shop";
$con = @mysql_connect($host,$user,$pass);
if (!$con){
  echo "<h2>Cannot connect to the database. Please try again later.</h2>";
  die();
}
$dbselect = @mysql_select_db($db,$con);
if (!$dbselect){
  echo "<h2>Cannot connect to the database. Please try again later.</h2>";
  die();
}
?>

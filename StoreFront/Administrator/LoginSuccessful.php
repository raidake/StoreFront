<?php
require_once("Adb.php");
require_once("loginlogspdo.php");

date_default_timezone_set('Asia/Singapore');
$timestamp = date("F j, Y, g:i a");

$date = date("Y-m-d");
$time = date("H:i:s");

$logging = "Username: $username , logged in at, time: $timestamp"; 


if ($crud->loginlogs($date,$time,$logging)){  //execute query
  echo "Query executed.";
}else{
  echo "Error executing query.";
}
 


?>
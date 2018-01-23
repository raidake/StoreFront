<?php
require_once("Adb.php");
require_once("logspdo.php");

date_default_timezone_set('Asia/Singapore');
$timestamp = date("F j, Y, g:i a");

$date = date("Y-m-d");
$time = date("H:i:s");

$logging = "Username: $username , profile was created at, time: $timestamp"; 


if ($logs->createLogs($date,$time,$logging)){  //execute query
  
}else{
  echo "Log error";
}
 


?>
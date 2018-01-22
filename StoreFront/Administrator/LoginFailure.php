<?php
$con = mysqli_connect("localhost","root","","auditor database"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

date_default_timezone_set('Asia/Singapore');
$timestamp = date("F j, Y, g:i a");

$date = date("Y-m-d");
$time = date("H:i:s");

$logging = "Username: '$username' , failed login at, time: '$timestamp'"; 

$query= $con->prepare("INSERT INTO `audit_logs`(`date`,`time`,`log_details`) VALUES(?,?,?)");

$query->bind_param('sss',$date,$time,$logging);
if ($query->execute()){  //execute query
  echo "Query executed.";
}else{
  echo "Error executing query.";
}
  




?>
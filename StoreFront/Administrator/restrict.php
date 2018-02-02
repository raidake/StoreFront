<?php

function checkAccess(){
	
//Set server time to Singapore
date_default_timezone_set("Singapore");

//Check if time is between 9 pmand 7 am and deny access if it is
//date("H") returns the hour in 24 hour time format
if(date("H")>20 && date("H")<7){
	session_start();
	$_SESSION['message']="We are currently closed. Our operating hours are from 7 am to 9 pm.";
	header("location: error.php");
}
}
checkAccess();
?>
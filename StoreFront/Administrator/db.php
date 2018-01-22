<?php

$DB_host = "fdb19.awardspace.net";
$DB_user = "2590948_employee";
$DB_pass = "mewk2018!";
$DB_name = "2590948_employee";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

include_once 'pdo.php';

$crud = new crud($DB_con);

$mysqli = mysqli_connect("localhost","root","","main"); //connect to database
if (!$mysqli){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

?>
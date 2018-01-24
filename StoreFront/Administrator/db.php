<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "employee";


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

$mysqli = mysqli_connect("localhost","root","","employee"); //connect to database
if (!$mysqli){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

?>
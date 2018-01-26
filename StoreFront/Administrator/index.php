<?php

require_once("sessionverify.php");
require_once("db.php");

if(isset($_POST["insert"])){
	if($_POST["insert"]=="yes")
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$fullname=$_POST["fullname"];
		$phonenum=$_POST["phonenum"];
		$email=$_POST["email"];
		$address=$_POST["address"];	
		$role=$_POST["role"];
		$error=0;
		
			if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phonenum']) && !empty($_POST['address']) && !empty($_POST['password'])){
	
//Check if username is made up of only alphanumberic characters
if(!ctype_alnum($username))
{
  echo "Username is not a valid string. Please enter only alphanumberic characters.";
 echo "<br />\n";
  $error=1;
}

//Check phone number
if(!preg_match("/^(3|6|8|9)\d{7}$/", $phonenum)) 
		{
		    echo "Phone numbers must be 8 numbers and Start with 3 OR 6 OR 8 OR 9.";
			echo "<br />\n";
			$error=1;
		}

//Check password complexitiy
if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/", $password)) 
		{
		   echo "Password invalid. Minimum 8 characters 1 number and 1 upper case.";
		   echo "<br />\n";
		   $error=1;
		}
if($error == 1){
	goto Area1;
}
	$hash = 0;
	$hash = password_hash($hash, PASSWORD_BCRYPT, ["cost" => 11]);
	
	if($crud->create($username, $hash, $fullname, $phonenum, $email, $address, $role)){
		require_once('insertlogs.php');
		echo "Record inserted!";
	}

	}
}
}

if(isset($_POST["update"])){
	if($_POST["update"]=="yes")
	{
	$username=$_POST["username"];
	$password=$_POST["password"];
	$fullname=$_POST["fullname"];
	$phonenum=$_POST["phonenum"];
	$email=$_POST["email"];
	$address=$_POST["address"];
	$role=$_POST["role"];
	$error=0;
	
	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phonenum']) && !empty($_POST['address'])){
	
//Check if username is made up of only alphanumberic characters
if(!ctype_alnum($username))
{
  echo "Username is not a valid string. Please enter only alphanumberic characters.";
 echo "<br />\n";
  $error=1;
}

//Check phone number
if(!preg_match("/^(3|6|8|9)\d{7}$/", $phonenum)) 
		{
		    echo "Phone numbers must be 8 numbers and Start with 3 OR 6 OR 8 OR 9.";
			echo "<br />\n";
			$error=1;
		}

//Check password complexitiy
if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/", $password)) 
		{
		   echo "Password invalid. Minimum 8 characters 1 number and 1 upper case.";
		   echo "<br />\n";
		   $error=1;
		}
if($error == 1){
	goto Area1;
}
	
	$hash = 0;
	$hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 11]);

	if($crud->update($username, $hash, $fullname, $phonenum, $email, $address, $role)){
		require_once('updatelogs.php');
		echo "Record updated!";
	}
	/*
	$query=$employeecon->prepare("update employee set username='$username' , hash='$hash', full_Name='$fullname', phone_Number='$phonenum', email='$email', address='$address', role='$role' where Employee_ID=".$_POST['id']);
	if($query->execute())
	{
		echo "<center>Record Updated!</center><br>";
	}
	*/
	}
}
}

if(isset($_GET['operation'])){
	if($_GET['operation']=="delete")
	{
	if($crud->delete($_GET['id'])){
		require_once('deletelogs.php');
		echo "Record deleted!";
	}
	}
}
?>
<html>
<body>
<b><center>CRUD</center></b>
<form method="post" action="index.php">
<table align="center" border="0">
<tr>
<td>username:</td>
<td><input type="text" name="username" /></td>
</tr>
<tr>
<td>password:</td>
<td><input type="text" name="password" /></td>
</tr>
<tr>
<td>fullname:</td>
<td><input type="text" name="fullname" /></td>
</tr>
<tr>
<td>phonenum:</td>
<td><input type="text" name="phonenum" /></td>
</tr>
<tr>
<td>email:</td>
<td><input type="text" name="email" /></td>
</tr>
<tr>
<td>address:</td>
<td><input type="text" name="address" /></td>
</tr>
<tr>
<td>role:</td>
<td><input type="text" name="role"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">
<input type="hidden" name="insert" value="yes" />
<input type="submit" value="Insert Record"/>
</td>
</tr>
</table>
</form>

<?php
Area1:
// Close connection
$crud->getRows();

?>
</body>
</html>
<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","main");
if (mysqli_connect_errno()){
	die('Could not connect: ' . mysqli_connect_errno());
}
include("../Header.php");
$user = $_POST['iuser'];
$pwd = $_POST['ipwd'];
$company_name = $_POST['icomp'];
$email = $_POST['imail'];
$number = $_POST['inumber'];
$address = $_POST['iaddr'];
$description = $_POST['idesc'];
$hash = password_hash($pwd, PASSWORD_BCRYPT, ["cost" => 11]);

$query= $con->prepare("INSERT INTO retailers (`username`, `hash`, `company_Name`, `e-mail`, `phone_Number`, `address`, `description`) VALUES 
('$user', '$hash', '$company_name', '$email', '$number', '$address', '$description')");
if ($query->execute()){
	echo "Query executed.";
}
else{
	echo "Error executing query.";
}
?>
</body>
</html>
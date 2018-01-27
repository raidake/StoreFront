<html>
<?php
$con=mysqli_connect("localhost","root","","main");		
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['captchaid'])){
$username=$_SESSION['username'];
$result=$con->query("SELECT * from retailers WHERE username='$username'");
$user=$result->fetch_assoc();
	if ( $_SESSION['otpid']!=$user['otp_verify']){
		$_SESSION['message']="Access denied. Invalid credentials";
		header("location:error.php");
	}
}
else{
	$_SESSION['message']="Access denied. Please login first.";
	header("location: error.php");
}
#$_SESSION['captchaid'];
#$_SESSION
?>
</html>
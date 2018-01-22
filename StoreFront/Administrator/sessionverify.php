<html>
<?php
$con=mysqli_connect("localhost","root","","employee");		
session_start();
if(isset($_SESSION['username'])){
$username=$_SESSION['username'];
$result=$con->query("SELECT * from employee WHERE username='$username'");
$user=$result->fetch_assoc();
	if ( $_SESSION['hash'] != $user['hash'] || $_SESSION['otp'] != $user['otp'] || $_SESSION['captcha'] != $user['captcha'] || $user['otp'] == 0 || $user['captcha'] == 0){
		$_SESSION['message']="Access denied. Invalid credentials.";
		header("location:error.php");
	}
}

#$_SESSION['captchaid'];
#$_SESSION
?>
</html>
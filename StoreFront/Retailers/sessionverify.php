<html>
<?php
$con=mysqli_connect("localhost","root","","main");		
//session_start();
if(isset($_SESSION['username']) && isset($_SESSION['captchaid'])){
$result=$con->query("SELECT * from retailers WHERE username='$username'");
$user=$result->fetch_assoc();
	if ( $_SESSION['hash']!=$user['hash'] || $_SESSION['captchaid'] != $user['captcha_verify'] || $_SESSION['otpid']!=$user['otp_verify'] || $user['otp_verify']==0 || $user['captcha_verify']==0){
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
<html>

<?php
$mysqli = mysqli_connect("localhost","root","","main"); 
if(isset($_POST['submit'])){
	session_start();
	$username=$_SESSION['username'];
	$query="SELECT otp_verify FROM retailers WHERE username='$username'";
	$result=$mysqli->query($query);

if($result->num_rows > 0){
while( $row=$result->fetch_assoc())
	if($_POST['otp']==$row['otp_verify']){
		$_SESSION['otpid']=$row['otp_verify'];
		header("location:retail_Inventory.php");
		}
	
	else{
		echo "OTP failed. Please try again.";
	}
}
else{
	echo $_SESSION['email'];
}
}
?>
<form method="POST" action="">

<input type="text" name="otp" placeholder="Enter OTP here">
<input type="submit" name="submit" value="Submit">

</form>

</html>
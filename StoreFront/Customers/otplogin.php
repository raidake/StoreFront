<html>

<?php
$mysqli = mysqli_connect("localhost","root","","main"); 
if(isset($_POST['submit'])){
	session_start();
	$email=$_SESSION['email'];
	$query="SELECT otp_verify FROM customers WHERE email='$email'";
	$result=$mysqli->query($query);

if($result->num_rows > 0){
while( $row=$result->fetch_assoc())
	if($_POST['otp']==$row['otp_verify']){
		$_SESSION['otp']=$_POST['otp'];
		header("location:index.php");
		}
	
	else{
		echo "OTP failed. Please try again.";
	}
}
}
?>
<form method="POST" action="">

<input type="text" name="otp" placeholder="Enter OTP here">
<input type="submit" name="submit" value="Submit">

</form>

</html>
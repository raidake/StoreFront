<html>

<?php
require_once("db.php");
if(isset($_POST['submit'])){
	session_start();
	$username=$_SESSION['username'];
	$query="SELECT otp FROM employee WHERE username='$username'";
	$result=$mysqli->query($query);

if($result->num_rows > 0){
while( $row=$result->fetch_assoc())
	if($_POST['otp']==$row['otp']){
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
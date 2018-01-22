<html>

<?php

if(isset($_GET['submit'])){
	include_once("crud.php");
	$crud->checkOTP($_POST['otp'];
}

?>
<form method="POST" action="">

<input type="text" name="otp" placeholder="Enter OTP here">
<input type="submit" name="submit" value="Submit">

</form>

</html>
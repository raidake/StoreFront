
<?php
$mysqli=mysqli_connect("localhost","root","","employee");

		$email="keith_teo@outlook.sg";
		$otpid=mt_rand(1000000,9999999);

		$query=$mysqli->prepare("update auditor set otp='$otpid' where email='$email'");
		$query->execute();
		if(mail($email, 'Storefront OTP','Your OTP is '.$otpid)){
		 echo "Email successfully sent";
	 }
	 else{
		echo "Email not sent.";
	 }

?>
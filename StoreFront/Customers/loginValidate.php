<?php
/*User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM customers WHERE email='$email'");
require_once('recaptchalib.php');

if ( $result->num_rows == 0 ) // User doesn't exist
{
	$_SESSION['message'] = "User with that email doesn't exist!";
	header("location: error.php");
}

else 
{
	//Check captcha before verifying password to prevent brute force 
		// your secret key
		$secret = "6Ld0HD8UAAAAAEPXHCbRLeOMRmNpTH6mUMYTpOIp";
 
		// empty response
		$response = null;
 
		// check secret key
		$reCaptcha = new ReCaptcha($secret);
		// if submitted check response
		if (isset($_POST["g-recaptcha-response"])) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]);
	}
}
//If captcha was a success
  if ($response != null && $response->success) {

  	// User exists
	$user = $result->fetch_assoc();

	// Ensure password matches
	if ( password_verify($_POST['password'], $user['hash']) )
	{
		// Your code here to handle a successful verification
		echo "Verification successful";
		$_SESSION['userid'] = $user['user_id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['gender'] = $user['gender'];
		$_SESSION['age'] = $user['age'];
		$_SESSION['address'] = $user['address'];
		$_SESSION['contact'] = $user['contact'];
		$_SESSION['email'] = $user['email'];
		
		//Set account type
		$_SESSION['accounttype']='customer';

		// This is how we'll know the user is logged in
		$_SESSION['logged_in'] = true;

		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;
		
		$mysqli->query("UPDATE customers SET captcha='$capid' WHERE email='$email'");

		$email=$user['email'];
		$otpid=mt_rand(1000000,9999999);
		$query=$mysqli->prepare("update customers set otp_verify='$otpid' where email='$email'");
		$query->execute();
		
	 	if(mail($email, 'Storefront OTP','Your OTP is '.$otpid)){
		 header("location: otplogin.php");
		}
		//header("location: profile.php");
	}
	else
	{
		$user_id=$_SESSION['user_id'];
		require_once('loginfailure.php');
		$_SESSION['message'] = "You have entered wrong password, try again";
		header("location: error.php");
	}
}
else 
{
	  echo "CAPTCHA failed";
}
?>

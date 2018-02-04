<?php
/*User login process, checks if user exists and password is correct */
// Escape email to protect against SQL injections
$mysqli = mysqli_connect("localhost","root","","main"); //connect to database
if (!$mysqli){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM retailers WHERE username='$username'");
require_once('recaptchalib.php');

if ( $result->num_rows == 0 ) // User doesn't exist
{
	$_SESSION['message'] = "User with that username doesn't exist!";
	header("location: error.php");
}
else // User exists
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
			$_POST["g-recaptcha-response"]
		);
}

//If captcha was a success
  if ($response != null && $response->success) {
	
	$user = $result->fetch_assoc();

	// Ensure password matches
	if ( password_verify($_POST['password'], $user['hash']) )
	{
    // Your code here to handle a successful verification
			echo "Verification successful";

		$_SESSION['username'] = $user['username'];
		$_SESSION['hash'] = $user['hash'];
		$_SESSION['retails_ID']=$user['retails_ID'];
		//Set session to tell account is customer or retailer
		$_SESSION['company_name']=$user['company_Name'];
		$_SESSION['email'] = $user['e-mail'];
		$_SESSION['contact']=$user['phone_Number'];
		$_SESSION['description']=$user['description'];
		$_SESSION['address']=$user['address'];

		// This is how we'll know the user is logged in
		
		$_SESSION['logged_in'] = true;
		$_SESSION['active'] = 0;
		
		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;
		
		$mysqli->query("UPDATE retailers SET `captcha_verify`='$capid' WHERE username='$username'");
		
		$email=0;
		$email=$user['e-mail'];
		$otpid=mt_rand(1000000,9999999);

		$query=$mysqli->prepare("update retailers set `otp_verify`='$otpid' where username='$username'");
		$query->execute();
		if(mail($email, 'Storefront OTP','Your OTP is '.$otpid)){
		 header("location: otplogin.php");
	 }

	}
	else
	{
		require_once('LoginFailure.php');
		$_SESSION['message'] = "You have entered wrong password, try again";
		echo "Login failed";
		header("location: error.php");
	}
} 
else {
	  echo "CAPTCHA failed";
  }

}
?>
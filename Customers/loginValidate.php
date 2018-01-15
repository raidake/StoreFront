<?php
/*User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM customers_information WHERE email='$email'");
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
			$_POST["g-recaptcha-response"]
		);
}

//If captcha was a success
  if ($response != null && $response->success) {

  	// User exists
	$user = $result->fetch_assoc();

	// Ensure password matches
	if ( password_verify($_POST['password'], $user['password']) )
	{
		// Your code here to handle a successful verification
		echo "Verification successful";

		$_SESSION['first_Name'] = $user['first_Name'];
		$_SESSION['last_Name'] = $user['last_Name'];
		$_SESSION['gender'] = $user['gender'];
		$_SESSION['age'] = $user['age'];
		$_SESSION['birthday'] = $user['birthday'];
		$_SESSION['address'] = $user['address'];
		$_SESSION['contact'] = $user['contact'];
		$_SESSION['email'] = $user['email'];

		// This is how we'll know the user is logged in
		$_SESSION['logged_in'] = true;
		$_SESSION['active'] = 0;

		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;
		
		$mysqli->query("UPDATE customer_information SET captcha='$capid' WHERE email='$email'");

		header("location: profile.php");
	}
	else
	{
		$_SESSION['message'] = "You have entered wrong password, try again";
		header("location: error.php");
	}
}
else 
{
	  echo "CAPTCHA failed";
  }
?>
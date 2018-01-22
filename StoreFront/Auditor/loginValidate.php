<?php
/*User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM auditor WHERE username='$username'");
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
		
		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;
		
		$mysqli->query("UPDATE auditor SET captcha='$capid' WHERE username='$username'");
		
		header("location: homepage.php");

	}
	else
	{
		$_SESSION['message'] = "Invalid password entered";
		echo "Login failed";
		header("location: error.php");
	}
} 
else {
	  echo "CAPTCHA failed";
  }

}
?>
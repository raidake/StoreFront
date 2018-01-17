<?php
// Set session variable to be used on profile.php page
$_SESSION['first_Name'] = $_POST['firstName'];
$_SESSION['last_Name'] = $_POST['lastName'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['age'] = $_POST['age'];
$_SESSION['birthday'] = $_POST['birthday'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['contact'] = $_POST['contact'];
$_SESSION['email'] = $_POST['email'];

// Escape all $_POST variables to protect against SQL injections
$first_Name = $mysqli->escape_string($_POST['firstName']);
$last_Name = $mysqli->escape_string($_POST['lastName']);
$gender = $mysqli->escape_string($_POST['gender']);
$age = $mysqli->escape_string($_POST['age']);
$birthday = $mysqli->escape_string($_POST['birthday']);
$address = $mysqli->escape_string($_POST['address']);
$contact = $mysqli->escape_string($_POST['contact']);
$email = $mysqli->escape_string($_POST['email']);

require_once('recaptchalib.php');

// Use the TimeStamp as Salt
$salt = $mysqli->escape_string( time() );
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 11]);
//$hash = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli-error());

// User Email exists if the rows returned are more than 0
if ( $result->num_rows > 0 )
{
	$SESSION['message'] = 'Email already exists! Please try again';
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
			$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]);
	}
}

//If captcha was a success
if ($response != null && $response->success) 
   // Email doesn't exist in a database, proceed to create account
{
	// active is 0 by default
	$sql = "INSERT INTO users (user_id, first_Name, last_Name, gender, age, birthday, address, contact, email, hash)"
		. "VALUES (NULL, '$first_Name', '$last_Name', '$gender', '
		$age', '$birthday', '$address', '$contact', '$email', '$hash')";

	// Add user into database
	if ( $mysqli->query($sql) )
	{
		$_SESSION['active'] = 0; // 0 until user activates their account with verify.php
		$_SESSION['logged_in'] = true; // So we know the user has logged in
		$_SESSION['message'] = 

				 "Confirmation link has been sent to $email, please verify your account by clicking on the link in the message!";

		// Sent Registration Confirmation Link (verify.php)
		$to	= $email;
		$subject = 'Account Verification (StoreFront)';
		$message = 'Hello '.$firstName.',

		Thank you for signing up!

		Please click this link to activate your account:

		http://localhost/Customers/verify.php?email='.$email.'&hash='.$hash;

		mail($to, $subject, $message);

		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;
		
		$mysqli->query("UPDATE users SET captcha_verify='$capid' WHERE email='$email'");
		
		header("location: profile.php");
	}

	else
	{
		$_SESSION['message'] = 'Registration Failed!';
		header("location: error.php");
	}
}
?>
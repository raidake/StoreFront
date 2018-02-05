<?php
// Set session variable to be used on profile.php page
$_SESSION['name'] = $_POST['name'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['age'] = $_POST['age'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['contact'] = $_POST['contact'];
$_SESSION['email'] = $_POST['email'];

// Escape all $_POST variables to protect against SQL injections
$name = $mysqli->escape_string($_POST['name']);
$gender = $mysqli->escape_string($_POST['gender']);
$age = $mysqli->escape_string($_POST['age']);
$address = $mysqli->escape_string($_POST['address']);
$contact = $mysqli->escape_string($_POST['contact']);
$email = $mysqli->escape_string($_POST['email']);

require_once('recaptchalib.php');

// Use the TimeStamp as Salt
$salt = $mysqli->escape_string( time() );
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 11]);
//$hash = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM customers WHERE email='$email'") or die($mysqli-error());

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
	$sql = "INSERT INTO customers (user_id, name, gender, age, address, contact, email, hash)"
		. "VALUES (NULL, '$name', '$gender', '
		$age', '$address', '$contact', '$email', '$hash')";

	// Add user into database
	if ( $mysqli->query($sql) )
	{
		$_SESSION['logged_in'] = true; // So we know the user has logged in

		//Generate CAPTCHA session id and update database (unset captcha value is 0)
		$capid=mt_rand(1000000,9999999);
		$_SESSION['captchaid']=$capid;

		$mysqli->query("UPDATE customers SET captcha_verify='$capid' WHERE email='$email'");
		header("location: /StoreFront/Customers/login.php");
	}

	else
	{
		$_SESSION['message'] = 'Registration Failed!';
		header("location: error.php");
	}
}
?>
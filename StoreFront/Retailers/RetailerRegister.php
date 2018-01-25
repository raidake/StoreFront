<?php
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Retailer Sign Up Form</title>
	<style type="text/css">@import "styles.css";
 
	body {font-family: Arial;}
	
	input[type=text], input[type=password], input[type=email], input[type=number]{
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 2px solid #ccc;
		box-sizing: border-box;
	}	
	
	input:focus { 
		outline:none;
		border-color:#9ecaed;
		box-shadow:0 0 10px #9ecaed;
	}
	/* style for all buttons */
	button { 
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 50%;
		position:absolute;
		left: 25%;
	}
	.signupbtn {
		width: 50%;
		color: #FF0000;
	}
	
	.container {
		padding: 50px;
		width:550px;
		margin: auto;
	}
	
	.clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
	input[type=submit] {
	width: 70%;
	background-color: #45a049;
	color: white;
	padding: 14px 20px;
	margin: 20px 75px;
	border: none; 
	border-radius: 4px;
	cursor: pointer;
	font-size: 16px;
}
	</style>
	<link rel="icon" href="favicon.ico">
</head>

<?php 
// Define variables and set to empty values for error output
$user_Name_Err = $password_Err = $email_Err = $company_Name_Err = $contact_Num_Err = $company_add_err = $company_desc_err = $verify_Password_Err = '';

function validate_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Counter to count and make sure all the field are valid
$isValid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST['register']))
	{
		/* Validate which fields are not of the correct type. 
		E.g No number for Name and etc.*/
		if (!preg_match("/^[a-zA-Z]*$/", $_POST["iuser"])) 
		{
			$user_Name_Err = "Only letters allowed";
		} 
		else
		{
			validate_input($_POST['iuser']);
			$isValid++;
		}
		/* Company Name */
		if (!preg_match("/^[a-zA-Z]*$/", $_POST["icomp"])) 
		{
			$company_Name_Err = "Only letters allowed";
		} 
		else
		{
			validate_input($_POST['icomp']);
			$isValid++;
		}
		/* Company Address */
		if (!preg_match("/^[a-zA-Z]*$/", $_POST["iaddr"])) 
		{
			$company_add_err = "Only letters allowed";
		} 
		else
		{
			validate_input($_POST['iaddr']);
			$isValid++;
		}
		/* Company Description */
		if (!preg_match("/^[a-zA-Z]*$/", $_POST["idesc"])) 
		{
			$company_desc_err = "Only letters allowed";
		} 
		else
		{
			validate_input($_POST['idesc']);
			$isValid++;
		}
		
		/* Using Regular expression to check string 
		that make sure it starts with 3,6,8 OR 9 and 
		make sure that it have 8 numbers in total.*/
		if(!preg_match("/^(3|6|8|9)\d{7}$/", $_POST["inumber"])) 
		{
	   		$contact_Num_Err = "Must be 8 numbers! (Start with 3 OR 6 OR 8 OR 9)";
		}
		else
		{
			validate_input($_POST['inumber']);
			$isValid++;
		}

		if (!filter_var($_POST["imail"], FILTER_VALIDATE_EMAIL))
		{
			$email_Err = "Invalid Email Format";
		}
		else
		{
			validate_input($_POST['imail']);
			$isValid++;
		}

		// using regular expression to check string 
		// /^ 				Start of string
		// (?=.*\p{Lu}) 	at least one uppercase letter
		// (?=.*\d.*\d) 	at least two digits
		// .{8} 			exactly 8 characters
		// $ 				End of string
		if(!preg_match("/^(?=.*\p{Lu})(?=.*\d).{8,}$/", $_POST["ipwd"])) 
		{
		   	$password_Err = "Minimum 8 characters (1 number and 1 upper case)";
		}
		else
		{
			validate_input($_POST['ipwd']);
			$isValid++;
		}

		if ($_POST["ipwd"] != $_POST["verifyPassword"])
		{
			$verify_Password_Err = "Unmatch Password";
		}
		else
		{
			$isValid++;
		}

		if ($isValid == 8)
		{		
			// Run the RetailerloginValidate.php if all the field are valid
			require 'RetailerloginValidate.php';
		}
	}
}
?>
<body>
<!--The value attributes is to save the form data 
if user refresh or enter the wrong data on the page. -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off" style="border:1px solid #ccc">

<div class="container">
<label>User Name: </label>
<input type="text" placeholder="Enter username" name="iuser" maxlength="15"  required
autocomplete="off" value="<?php echo isset($_POST["iuser"]) ? $_POST["iuser"] : '';?>">
<span class="error"><?php echo $user_Name_Err;?></span>
<br><br>

<label>Password: </label>
<input type="password" placeholder="Enter Password" name="ipwd" maxlength="32" required autocomplete="off"> 
<span class="error"><?php echo $password_Err;?></span>
<br><br>

<label>Verify Password: </label>
<input type="password" required name="verifyPassword" placeholder="Verify Password" maxlength="32" autocomplete="off">
<span class="error"><?php echo $verify_Password_Err;?></span>
<br><br>

<label>Email: </label>
<input type="email" placeholder="Enter E-Mail" name="imail" maxlength="254" required autocomplete="off" value="<?php echo isset($_POST["imail"]) ? $_POST["imail"] : '';?>">
<span class="error"><?php echo $email_Err;?></span>
<br><br>

<label>Company Name: </label>
<input type="text" placeholder="Enter Company Name" name="icomp" maxlength="100" required autocomplete="off" value="<?php echo isset($_POST["icomp"]) ? $_POST["icomp"] : '';?>">
<span class="error"><?php echo $company_Name_Err;?></span>
<br><br>

<label>Contact Number: </label>
<input type="tel" placeholder="E.g 96578976" maxlength="8" name="inumber" required autocomplete="off" value="<?php echo isset($_POST["inumber"]) ? $_POST["inumber"] : '';?>"> 
<span class="error"><?php echo $contact_Num_Err;?></span>
<br><br>

<label>Company Address: </label>
<textarea type="text" style="height:200px; width:550px; font-family:arial; resize:none" placeholder="Enter Company Address" maxlength="100" name="iaddr" autocomplete="off" value="<?php echo isset($_POST["iaddr"]) ? $_POST["iaddr"] : '';?>"></textarea>
<span class="error"><?php echo $company_add_err;?></span>
<br><br>

<label>Company Description: </label>
<textarea type="text" style="height:200px; width:550px; font-family:arial; resize:none" placeholder="Not more than 200 words...." maxlength="200" name="idesc" autocomplete="off" value="<?php echo isset($_POST["idesc"]) ? $_POST["idesc"] : '';?>"></textarea>
<span class="error"><?php echo $company_desc_err;?></span>
<br><br>

<!-- Recaptcha SiteKey -->
<div class="g-recaptcha" data-sitekey="6Ld0HD8UAAAAAMxiWj583ViTCadVeXo5pP5GU4Vx"></div>
<br></br>
</form>
<div class="clearfix">
<input type="submit" name="signupbtn" value="Register as Retailers">
</div>
<p>Already have an account? <a href="RetailerLogin.php">Sign in to Retailers</a></p>	
<!-- Recaptcha API Javascript Library -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
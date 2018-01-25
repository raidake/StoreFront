<?php
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customers Sign Up Form</title>
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>

<?php 
// Define variables and set to empty values for error output
$first_Name_Err = $last_Name_Err = $gender_Err = $age_Err = $birthday_Err = $address_Err = $contact_Err = $email_Err = $password_Err = $verify_Password_Err = '';

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
		if (!preg_match("/^[a-zA-Z ]*$/", $_POST["firstName"])) 
		{
			$first_Name_Err = "Only letters allowed";
		} 
		else
		{
			validate_input($_POST['firstName']);
			$isValid++;
		}

		if (!preg_match("/^[a-zA-Z ]*$/", $_POST["lastName"])) 
		{
			$last_Name_Err = "Only letters allowed";
		}
		else
		{
			validate_input($_POST['lastName']);
			$isValid++;
		}

		$options = array('Male', 'Female', 'Other');
		// Validation check for gender
		if (!in_array($_POST["gender"], $options)) 
		{
			$gender_Err = "Gender is required";
		}
		else
		{
			validate_input($_POST['gender']);
			$isValid++;
		}

		if (!(isset($_POST["age"]) and is_numeric($_POST["age"]))) 
		{
			$age_Err = "Age is required";
		} 
		else
		{
			validate_input($_POST['age']);
			$isValid++;
		}

		if (!(isset($_POST["birthday"]) and strtotime($_POST["birthday"]))) 
		{
			$birthday_Err = "Birthday is required";
		}
		else
		{
			validate_input($_POST['birthday']);
			$isValid++;
		}

		/* Using Regular expression to check string 
		that make sure it starts with 3,6,8 OR 9 and 
		make sure that it have 8 numbers in total.*/
		if(!preg_match("/^(3|6|8|9)\d{7}$/", $_POST["contact"])) 
		{
	   		$contact_Err = "Must be 8 numbers! (Start with 3 OR 6 OR 8 OR 9)";
		}
		else
		{
			validate_input($_POST['contact']);
			$isValid++;
		}

		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$email_Err = "Invalid Email Format";
		}
		else
		{
			validate_input($_POST['email']);
			$isValid++;
		}

		// using regular expression to check string 
		// /^ 				Start of string
		// (?=.*\p{Lu}) 	at least one uppercase letter
		// (?=.*\d.*\d) 	at least two digits
		// .{8} 			exactly 8 characters
		// $ 				End of string
		if(!preg_match("/^(?=.*\p{Lu})(?=.*\d).{8,}$/", $_POST["password"])) 
		{
		   	$password_Err = "Minimum 8 characters (1 number and 1 upper case)";
		}
		else
		{
			validate_input($_POST['password']);
			$isValid++;
		}

		if ($_POST["password"] != $_POST["verifyPassword"])
		{
			$verify_Password_Err = "Unmatch Password";
		}
		else
		{
			$isValid++;
		}

		if ($isValid == 9)
		{		
			// Run the registerValidate.php if all the field are valid
			require 'registerValidate.php';
		}
	}
}
?>
<body>
	<div class="top-nav-bar">
		<a class="main" href="#home"><center>StoreFront Customers Registration</center></a>
	</div>
<div class="boxed">
<!--The value attributes is to save the form data 
if user refresh or enter the wrong data on the page. -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off">

<label>First Name: </label>
<input type="text" required name="firstName" placeholder="Surname" autocomplete="off" value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : '';?>">
<span class="error"><?php echo $first_Name_Err;?></span>
<br><br>

<label>Last Name: </label>
<input type="text" required name="lastName" placeholder="Your name" autocomplete="off" value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : '';?>">
<span class="error"><?php echo $last_Name_Err;?></span>
<br><br>

<label>Gender: </label>
<select name="gender" required>
	<option value="Male">Male</option>
	<option value="Female">Female</option>
	<option value="Other">Other</option>
</select>
<span class="error"><?php echo $gender_Err;?></span>
<br><br>

<label>Age: </label>
<input type="number" required name="age" min="1" max="100" autocomplete="off">
<span class="error"><?php echo $age_Err;?></span>
<br><br>

<label>Birthday: </label>
<input type="date" required name="birthday" autocomplete="off" value="<?php echo isset($_POST["birthday"]) ? $_POST["birthday"] : '';?>">
<span class="error"><?php echo $birthday_Err;?></span>
<br><br>

<label>Address: </label>
<input type="text" required name="address" autocomplete="off" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : '';?>">
<span class="error"><?php echo $address_Err;?></span>
<br><br>

<label>Contact Number: </label>
<input type="tel" required name="contact" placeholder="E.g 96578976" autocomplete="off" value="<?php echo isset($_POST["contact"]) ? $_POST["contact"] : '';?>">
<span class="error"><?php echo $contact_Err;?></span>
<br><br>

<label>Email: </label>
<input type="email" required name="email" autocomplete="off" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '';?>">
<span class="error"><?php echo $email_Err;?></span>
<br><br>

<label>Password: </label>
<input type="password" required name="password" placeholder="At least 8 characters" autocomplete="off">
<span class="error"><?php echo $password_Err;?></span>
<br><br>

<label>Verify Password: </label>
<input type="password" required name="verifyPassword" placeholder="Verify Password" autocomplete="off">
<span class="error"><?php echo $verify_Password_Err;?></span>
<br><br>

<!-- Recaptcha SiteKey -->
<div class="g-recaptcha" data-sitekey="6Ld0HD8UAAAAAMxiWj583ViTCadVeXo5pP5GU4Vx"></div>
<br></br>

<input type="submit" name="register" value="Register as Customers">
</form>
<p>Already have an account? <a href="login.php">Sign in to Customers</a></p>	
</div>
<!-- Recaptcha API Javascript Library -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>
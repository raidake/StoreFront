<?php
/*Display user information and some useful messages upon logging in*/
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 )
{
	$_SESSION['message'] = "You must log in before viewing your profile page!";
	header("location: error.php");
}
else
{
	// Assign to variable that is easier to read
	$first_Name = $_SESSION['first_Name'];
	$last_Name = $_SESSION['last_Name'];
	$gender = $_SESSION['gender'];
	$age = $_SESSION['age'];
	$birthday = $_SESSION['birthday'];
	$address = $_SESSION['address'];
	$contact = $_SESSION['contact'];
	$email = $_SESSION['email'];

	$active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?= $first_Name.' '.$last_Name ?></title>
</head>
<body>
		<h1>Welcome</h1>
		<p>
		<?php
		// Display message about account verfication link only once
		if ( isset($_SESSION['message']) )
		{
			echo $_SESSION['message'];

			// Don't annoy the user with more messages upon page refresh
			unset( $_SESSION['message'] );
		}
		?>
		</p>

		<?php
		// Keep reminding the user this account is not active, until they activate
		if ( !$active )
		{
			echo 
			'<div class="info">
			Account is unverified, please confirm your email by clicking on the email link!
			</div>';
		}		
		?>

		<h2><?php echo $first_Name.' '.$last_Name; ?></h2>
		<p><?= $email ?></p>

		<table align='center' border='1'>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Birthday</th>
				<th>Address</th>
				<th>Contact</th>
				<th>Email</th>
			</tr>

			<tr>
				<td><?php echo $first_Name ?></td>
				<td><?php echo $last_Name ?></td>
				<td><?php echo $gender ?></td>
				<td><?php echo $age ?></td>
				<td><?php echo $birthday ?></td>
				<td><?php echo $address ?></td>
				<td><?php echo $contact ?></td>
				<td><?php echo $email ?></td>
			</tr>
		</table>

		<a href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
</body>
</html>
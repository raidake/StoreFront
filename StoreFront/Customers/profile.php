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
	<style>
		header, footer {
    		padding: 1em;
    		color: white;
    		background-color: black;
    		clear: left;
    		text-align: center;
		}	
		div.layout1 {
			width: 100%;
			border: 0px solid gray;
		}
		div.layout2 {
			float: left;
			max-width: 160px;
			margin: 0;
			padding: 1em;
		}
		div.layout3 {
			margin-left: 200px;
			border-left: 0px solid gray;
			border-bottom: 5px solid black;
			padding: 1em;
			overflow: hidden;
		}
		div.layout4 {
			margin-left: 200px;
			border-left: 0px solid gray;
			padding: 1em;
			overflow: hidden;
		}
		div.layout5 {
			margin-left: 200px;
			border-left: 0px solid gray;
			padding: 1em;
			overflow: hidden;
		}
		img {
			width: 120px;
			height: 80px
		}
		label {
			font-size: 20px;
		}
	</style>
</head>
<body>
	<div class="layout1">
		<header>
		<h1><center>StoreFront</center></h1>
		</header>
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

		<p>Email: <?= $email ?></p>
	</div>

	<div class="layout2">
		<picture>
			<img src="https://cimages.prvd.com/is/image/ProvideCommerce/FE_15_CDLD_W1_SQ?$PFCProductImage$" alt="userprofile">
		</picture>
	</div>

	<div class="layout3">
		<!-- Name -->
		<label><b>Name: </b><?php echo $first_Name.' '.$last_Name; ?></label>
	</div>

	<div class="layout4">	
		<!-- Description (Retailers) -->
		<label><b>Description (Retailers): </b></label>
	</div>

	<div class="layout5">
		<!-- Review Made (Customers) -->
		<label><b>Reviews: </b></label>
	</div>

		<a href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
		<br><br><br><br><br><br><br><br><br><br>
		<footer>Copyright &copy; StoreFront.com</footer>
</body>
</html>
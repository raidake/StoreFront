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
	if($_SESSION['accounttype']=='customer')
	{
		// Assign to variable that is easier to read
	$name = $_SESSION['name'];
	$gender = $_SESSION['gender'];
	$age = $_SESSION['age'];
	$address = $_SESSION['address'];
	$contact = $_SESSION['contact'];
	$email = $_SESSION['email'];
	}
	else if($_SESSION['accounttype']=='retailer')
	{
		$email = $_SESSION['email'];
		$username = $_SESSION['username'];
		$company_name = $_SESSION['company_name'];
		$contact = $_SESSION['contact'];
		$address = $_SESSION['address'];
		$description = $_SESSION['description'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?= $name ?></title>
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

		<p>Email: <?php echo $email ?></p>
	</div>

	<div class="layout2">
		<picture>
			<img src="https://cimages.prvd.com/is/image/ProvideCommerce/FE_15_CDLD_W1_SQ?$PFCProductImage$" alt="userprofile">
		</picture>
	</div>

	<div class="layout3">
		<!-- Name -->
		<?php if($_SESSION['accounttype'] == 'retailer')
		{
			?>
		<label><b>Company Name: </b><?php echo $company_name; ?></label>
		<?php }
		else
		{
		?>
		<label><b>Name: </b><?php echo $name ?></label>
		<?php
		}
		?>
	</div>
	<?php if($_SESSION['accounttype'] == 'retailer')
	{ ?>
		<div class="layout4">	
			<!-- Description (Retailers) -->
			<label><b>Description (Retailers):</b></label><br>
			<?php echo $description ?>
		</div>
	<?php }
	else
	{
	?>
	<div class="layout5">
		<!-- Review Made (Customers) -->
		<label><b>Reviews: </b></label>
	</div>
	<?php
	}
	?>
	<a href="/StoreFront/Retailers/retail_Inventory.php">Go to home</a>

		<a href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
		<br><br><br><br><br><br><br><br><br><br>
		<footer>Copyright &copy; StoreFront.com</footer>
</body>
</html>
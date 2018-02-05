<?php
/*Display user information and some useful messages upon logging in*/
session_start();
include_once './Retailers/dbconfig.php';

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 )
{
	$_SESSION['message'] = "You must log in before viewing your profile page!";
	header("location: error.php");
	
}
else
{
	//if($_SESSION['accounttype']=='customer')
	//{
		// Assign to variable that is easier to read
	$name = $_SESSION['name'];
	$gender = $_SESSION['gender'];
	$age = $_SESSION['age'];
	$address = $_SESSION['address'];
	$contact = $_SESSION['contact'];
	$email = $_SESSION['email'];
	//}
	/*else if($_SESSION['accounttype']=='retailer')
	{
		$email = $_SESSION['email'];
		$username = $_SESSION['username'];
		$company_name = $_SESSION['company_name'];
		$contact = $_SESSION['contact'];
		$address = $_SESSION['address'];
		$description = $_SESSION['description'];
	}*/
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
	div.layout3 {
	display: block;
	float:left;
	max-height: 100px;
	max-width: 200px;
	padding: 20px;
}

div.layout4 {
	display: block;
	margin-left: 220px;
	border-left: 1px solid gray;
	padding: 40px;
	margin-top: 40px;
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
	
	<div class="layout5">
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
		<div class="layout6">	
			<!-- Description (Retailers) -->
			<label><b>Description (Retailers):</b></label><br>
			<?php echo $description ?>
		</div>
	<?php }
	?>
		<?php
		
		$stmt = $DB_con->prepare("select * from retail_items");
		$stmt->execute();
		
		if($stmt->rowCount() > 0)
		{
			$array = array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				array_push($array, $row['item_ID']);
			}
			$rand_keys = array_rand($array, 3);
			for($i = 0; $i < 3; $i++)
			{
				$key = $array[$rand_keys[$i]];
				if(print($row['active']) == 1)
				{
					echo "<br>";
					extract($crud->getID($key));
					
					?>
						<div class="layout3">
							<img src="<?php echo $image; ?>">
						</div>
						<div class="layout4">
							<label><b>Item Name:</b></label>
							<?php echo $item_Name; ?></a>
							<br>
							<label><b>Item Cost:</b></label>
							<?php echo $item_Cost; ?>
							<br>
							<label><b>Quantity:</b></label>
							<input id="quantity" type="number" min="1" max="100" value="0">
							<button onclick="buyFunction()">Buy</button>
							<br>
							<label><b>Reviews: </b></label><label id="reviews"></label>
							<p id="buy"></p>
						</div>
					<?php
						}			
			}
						
		}
		?>
		<a href="logout.php"><input type="submit" name="logout" value="Log Out"></a>
		<br><br><br><br><br><br><br><br><br><br>
		<footer>Copyright &copy; StoreFront.com</footer>

		<script>
			function buyFunction()
			{
				var quantity = document.getElementById("quantity");
				var quantityNumber = document.getElementById("quantity").value;
				for (i = 0; i < quantityNumber.length; i++)
				{
					if (!quantity.checkValidity())
				{
					document.getElementById("buy").innerHTML = quantity.validationMessage;
				}
				else
				{
					alert("Successfully bought " + quantityNumber + " product!");
					var reviews = prompt("Do you want to give reviews about the product?");
					if (reviews != null)
					{
						document.getElementById("reviews").innerHTML = reviews;
					}
				}
				}			
				document.getElementById("quantity").value = 0;
				/*for (i = 0; i < quantity.length; i++)
				{
						if (quantity[i] >= 1)
						{
							alert("Successfully bought " + quantity + " product!");
							var comment = prompt("Do you want to give comment about the product?");
							if (comment != null)
							{
								document.getElementById("buy").innerHTML = comment;
							}
						}
						else if (quantity[i] <= 0)
						{
							alert("Please enter a valid value to buy");
						}
					document.getElementById("quantity").value = 0;
				}*/
				/*for (i = 0; i < quantity.length; i++)
				{
					if (quantity[i] <= 0)
					{
						document.getElementById("buy").innerHTML = "Please enter a valid value to buy";
					}
					else
					{
						document.getElementById("buy").innerHTML = "";
						alert("Successfully bought " + quantity);
					}
				}*/
			}
		</script>
</body>
</html>
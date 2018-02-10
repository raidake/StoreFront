<?php
include_once './Retailers/dbconfig.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>StoreFront</title>
	<meta name="viewport" content="width=device-width", initial-scale="1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
header, footer {
    padding: 20px;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
}

button {
	width: 30%;
	background-color: #45a049;
	color: white;
	padding: 14px 20px;
	margin: 12px 110px;
	border: none; 
	border-radius: 4px;
	cursor: pointer;
	font-size: 16px;
	float: center;
}

input[type=submit] {
	width: 30%;
	background-color: #45a049;
	color: white;
	padding: 14px 20px;
	margin: 12px 110px;
	border: none; 
	border-radius: 4px;
	cursor: pointer;
	font-size: 16px;
}
div.layout2 {
	height: 30px;
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

input[type=text] {
	width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
input[type=text]:focus {
    width: 100%;
}
img {
	width: 160px;
	height: 130px;
	margin-top: 20px;
}
label {
	font-size: 20px;
}
</style>
</head>
<body>
	<div class="container">
	<header>
    <h1><center>StoreFront<center></h1>
	<div id="profile" style="float:right">
		<a href="/StoreFront/Profile.php">View Profile</a>
	</div>
	</header>
	<?php
	 if(!$_SESSION['logged_in'])
	 {
	?>
		<!-- Multi Modal for REGISTER -->
		<div class="w3-container">
  		<center><button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Register</button></center>

  		<div id="id01" class="w3-modal">
    	<div class="w3-modal-content">
		<header class="w3-container w3-teal"> 
    	<span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Choose your Option</h2>
        </header>
      	<div class="w3-container">
		<center><a href="/StoreFront/Customers/register.php"><input type="submit" value="Register as Customers"></a></center>
		<center><a href="/StoreFront/retailers/RetailerRegister.php"><input type="submit" value="Register as Retailers"></a></center>
      	</div>
      		<footer class="w3-container w3-teal">
        	<p>Thank You!</p>
      	</footer>
      	</div>
  		</div>
  		</div>

		<!-- Multi Modal for LOGIN -->
		<div class="w3-container">
  		<center><button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">Login</button></center>

  		<div id="id02" class="w3-modal">
    	<div class="w3-modal-content">
		<header class="w3-container w3-teal"> 
    	<span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Choose your Option</h2>
        </header>
      	<div class="w3-container">
		<center><a href="/StoreFront/Customers/login.php"><input type="submit" value="Login as Customers"></a></center>
		<center><a href="/StoreFront/Retailers/RetailerLogin.php"><input type="submit" value="Login as Retailers"></a></center>
      	</div>
      		<footer class="w3-container w3-teal">
        	<p>Thank You!</p>
      	</footer>
      	</div>
  		</div>
  		</div>
	<?php
	 }
	?>
  		<div class="layout2">
  			<form action="search.php">
				<br>
  				<center><input type="text" name="search" placeholder="Search"></center>
  			</form>
  		</div>
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

			$rand_keys = array_rand($array, $stmt->rowCount());
			shuffle($rand_keys);
			$check = 0;
			foreach($rand_keys as $r)
			{
				$key = $array[$r];
				extract($crud->getID($key));
				if($active == 1)
				{
					echo "<br>";
					extract($crud->getID($key));
					$check++;
					?>
						<div class="layout3">
							<img src="<?php echo $image; ?>">
						</div>
						<div class="layout4">
							<label><b>Item Name:</b></label>
							<a href="./Retailers/retailItem.php?item_id=<?php echo $item_ID; ?>"><?php echo $item_Name; ?></a>
							<br>
							<label><b>Item Cost:</b></label>
							<?php echo $item_Cost; ?>
						</div>
					<?php
				}
				if($check == 3)
				{
					break;
				}
			}
			if($check == 0)
			{
			?>
				<div class="layout4">
					<label><b>No items are available. Sorry!</b></label>
				</div>
			<?php
			}
		}

	?>
	<br> <br>
	<footer>Copyright &copy; StoreFront.com</footer>
	</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>StoreFront</title>
	<meta name="viewport" content="width=device-width", initial-scale="1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
header, footer {
    padding: 1em;
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
	float: left;
	max-width: 160px;
	margin: 0;
	padding: 1em;
}

div.layout4 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 150px;
	margin-top: 50px;
}
div.layout5 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 150px;
	margin-top: -10px;
}
div.layout6 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 150px;
	margin-top: -10px;
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
	</header>
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
		<center><a href="/StoreFront/Customers/register.php"><input type="submit" value="Register as Retailers"></a></center>
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
		<center><a href="/StoreFront/Customers/login.php"><input type="submit" value="Login as Retailers"></a></center>
      	</div>
      		<footer class="w3-container w3-teal">
        	<p>Thank You!</p>
      	</footer>
      	</div>
  		</div>
  		</div>

  		<div class="layout2">
  			<form>
  				<center><input type="text" name="search" placeholder="Search"></center>
  			</form>
  		</div>

		<div class="layout3">
		<picture>
			<!-- They are 3 fields for this, Item Picture, Name and Cost-->
		<img src="http://cityscoop.us/bocaratonfl-signs/files/2017/05/Storefront-Signs-Graphics-Sign-Partners004.jpg" alt="item1">
		<img src="http://www.methoddesign.com/wp-content/uploads/2010/07/PTN-STOREFRONT1.jpg" alt="item2">
		<img src="http://www.carlsons-stores.com/g-storefront4.jpg" alt="item3">
		</picture>
	</div>

	<div class="layout4">
		<!-- Name & Item Cost -->
		<label><b>Item Name:</b></label>
		<br></br>
		<label><b>Item Cost:</b></label>
	</div>

	<div class="layout5">
		<!-- Name & Item Cost -->
		<label><b>Item Name:</b></label>
		<br></br>
		<label><b>Item Cost:</b></label>
	</div>

	<div class="layout6">
		<!-- Name & Item Cost -->
		<label><b>Item Name:</b></label>
		<br></br>
		<label><b>Item Cost:</b></label>
	</div>
	<footer>Copyright &copy; StoreFront.com</footer>
	</div>
</body>
</html>
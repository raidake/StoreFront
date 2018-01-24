<!DOCTYPE html>
<html>
<head>
	<title>StoreFront</title>
	<style>

header, footer {
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
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
	float: left;
	max-width: 160px;
	margin: 0;
	padding: 1em;
}

div.layout3 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 130px;
	margin-top: 50px;
}
div.layout4 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 130px;
	margin-top: -50px;
}
div.layout5 {
	margin-left: 200px;
	border-left: 1px solid gray;
	padding: 2em;
	overflow: hidden;
	height: 130px;
	margin-top: -50px;
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
		<a href="register.php"><input type="submit" value="Register"></a>
		<a href="login.php"><input type="submit" value="Login"></a>
		<p></p>

		<div class="layout2">
		<picture>
			<!-- They are 3 fields for this, Item Picture, Name and Cost-->
		<img src="http://cityscoop.us/bocaratonfl-signs/files/2017/05/Storefront-Signs-Graphics-Sign-Partners004.jpg" alt="item1">
		<img src="http://www.methoddesign.com/wp-content/uploads/2010/07/PTN-STOREFRONT1.jpg" alt="item2">
		<img src="http://www.carlsons-stores.com/g-storefront4.jpg" alt="item3">
		</picture>
	</div>

	<div class="layout3">
		<!-- Name & Item Cost -->
		<label><b>Item Name:</b></label>
		<br></br>
		<label><b>Item Cost:</b></label>
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
	<footer>Copyright &copy; StoreFront.com</footer>
	</div>
</body>
</html>
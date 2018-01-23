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
.error {
	color: #FF0000;
	font-size: 13px;
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

img {
	width: 20%;
	padding: 12px 20px;
	margin: 8px 10px;
	display: inline-block;
	border: 0px solid #ccc;
	border-radius: 4px;
	box-sizing: border-box;
}

label {
	display: inline-block;
	margin-left: 20px;
	font-size: 16px;
	float: left;
}

.boxed {
	border: 2px solid silver;
	padding: 25px;
	margin: 25px;
	margin-left: 25%;
	width: 600px;
}

</style>
</style>
</head>
<body>
	<div class="container">
	<header>
    <h1><center>StoreFront<center></h1>
	</header>
		<a href="register.php"><input type="submit" value="Register"></a>
		<a href="login.php"><input type="submit" value="Login"></a>
		<p></p><p></p><p></p><p></p>
		<!-- They are 3 fields for this, Item Picture, Name and Cost-->
		<img src="http://cityscoop.us/bocaratonfl-signs/files/2017/05/Storefront-Signs-Graphics-Sign-Partners004.jpg" alt="StoreFront" width="100" height="150">
		<!-- Name -->
		<span class="error"><?php echo $last_Name_Err;?></span>
		<!-- Cost -->
		<span class="error"><?php echo $last_Name_Err;?></span>

		<img src="http://www.methoddesign.com/wp-content/uploads/2010/07/PTN-STOREFRONT1.jpg" alt="StoreFront" width="100" height="150">
		<span class="error"><?php echo $last_Name_Err;?></span>
		<span class="error"><?php echo $last_Name_Err;?></span>

		<img src="http://www.carlsons-stores.com/g-storefront4.jpg" alt="StoreFront" width="100" height="150">
		<span class="error"><?php echo $last_Name_Err;?></span>
		<span class="error"><?php echo $last_Name_Err;?></span>

		<img src="https://www.dynamicwindows.com/wp-content/uploads/2014/09/bodega-steel-storefront-1024x768-wm.jpg" alt="StoreFront" width="100" height="150">
		<span class="error"><?php echo $last_Name_Err;?></span>
		<span class="error"><?php echo $last_Name_Err;?></span>

	<footer>Copyright &copy; StoreFront.com</footer>
	</div>
</body>
</html>
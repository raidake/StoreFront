<html>
<head>
    <title>Company Registration</title>
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
	</style>
	<link rel="icon" href="favicon.ico">
</head>
	<body>
	
	<?php include("../Header.php");?>
	<form action="input_Register.php" method="post" style="border:1px solid #ccc" autocomplete="off">
		<div class="container">
			<label><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="iuser" maxlength="15" required>
			
			<label><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="ipwd" maxlength="32" required> 
			
			<label><b>E-Mail</b></label>
			<input type="email" placeholder="Enter E-Mail" name="imail" maxlength="254" required>
			
			<label><b>Company Name</b></label>
			<input type="text" placeholder="Enter Company Name" name="icomp" maxlength="100" required>
			
			<label><b>Contact Number</b></label>
			<input type="number" placeholder="Enter Contact Number" maxlength="8" name="inumber" required> 
			
			<label><b>Company Address</b></label>
			<textarea type="text" style="height:200px; width:550px; font-family:arial; resize:none" placeholder="Enter Company Address" maxlength="100" name="iaddr" ></textarea>
			
			<label><b>Company Description</b></label>
			<textarea type="text" style="height:200px; width:550px; font-family:arial; resize:none" placeholder="Not more than 200 words...." maxlength="200" name="idesc" ></textarea>
			
		
	</form>
	<div class="clearfix">
		<button type="submit" value="signupbtn" >Register</button>
	</div>
</body>
</html>
<?php
/* Display all successful messages */
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
</head>
<body>
	<h1>Success</h1>
	<p>
		<?php
		if ( isset($_SESSION['message']) AND !empty($_SESSION['message']))
		{
			echo $_SESSION['message'];
		}
		else
		{
			header("location: index.php");
		}
		?>
	</p>
	<a href="/StoreFront/Customers/login.php"><input type="submit" name="Home" value="Login"></a>
</body>
</html>
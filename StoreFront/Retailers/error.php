<?php
/*Display all error message */
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
<body>
<p>
<?php
if ( isset($_SESSION['message']) AND !empty($_SESSION['message'])):
	echo $_SESSION['message'];
else:
	//header("location: RetailerLogin.php");
	echo "AEFA";
endif;
?>
</p>
<a href="RetailerLogin.php"><input type="submit" value="Home"></a>
</body>
</html>
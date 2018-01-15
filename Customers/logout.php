<?php
/*Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log Out</title>
</head>
<body>
		<h1>Thanks for stopping by on our website!</h1>
		<p><?= 'You have been logged out!'; ?></p>
		<a href="index.php"><input type="submit" value="Log Out"></a>
</body>
</html>
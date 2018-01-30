<html>
<body>
<ul>
 <!-- The [ back ] button to return to homepage-->
	<form action="homepage.php" >
	<input type="submit" value="back">
	</form>
 <ul>
<b><center>Audit Logs</center></b>

<?php
require_once("sessionverify.php");
require_once("Adb.php");
//Reads all the logs in the "audit_logs" table
$crud->getRows();

?>

</body>
</html>
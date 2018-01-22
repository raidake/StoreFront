<html>
<body>
<ul>
	<a href="../Pdo/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
<ul>
<b><center>Audit Logs</center></b>

<?php
require_once("Adb.php");
//Reads all the logs in the "audit_logs" table
$crud->getRows();

?>

</body>
</html>
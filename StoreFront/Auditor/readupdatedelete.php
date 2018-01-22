<?php
require_once("Adb.php");

//updates the remarks according to the log ID specified
if(isset($_POST["update"])){
	if($_POST["update"]=="yes")
	{
		$log_ID=$_POST['log_ID'];
		$remarks=$_POST['remarks'];	
	}
	if($crud->update($remarks,$log_ID))
	{
		echo "<center>Remark Updated!</center><br>";
	}
	
}
//deletes the remark according to the log ID specified
if(isset($_GET['operation'])){
	if($_GET['operation']=="delete")
	{
		$log_ID=$_GET['log_ID'];
		if($crud->delete($log_ID))
		{
		echo "<center>Remark Deleted!</center><br>";
		}
	}
}
?>
<html>
<body>
<ul>
	<a href="../pdo/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
<ul>
<b><center>Audit Logs</center></b>

<?php
//reads the logs that have something written in the remarks (in other words, not empty remarks)
//if the remark is empty, the table will not show that log as there is nothing to update or delete  
$crud->updateDelete();

?>

</body>
</html>
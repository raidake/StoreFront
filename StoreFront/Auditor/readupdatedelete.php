<?php
$connect=mysqli_connect("localhost","root","","auditor database");

//updates the remarks according to the log ID specified
if(isset($_POST["update"])){
	if($_POST["update"]=="yes")
	{
		$log_ID=$_POST['log_ID'];
		$remarks=$_POST['remarks'];	
	}
	$query=$connect->prepare("UPDATE audit_logs SET remarks='$remarks' WHERE log_ID='$log_ID'");
	if($query->execute())
	{
		echo "<center>Remark Updated!</center><br>";
	}
	
}
//deletes the remark according to the log ID specified
if(isset($_GET['operation'])){
	if($_GET['operation']=="delete")
	{
		$query=$connect->prepare("UPDATE audit_logs SET remarks='' WHERE log_ID=".$_GET['log_ID']);
		if($query->execute())
		{
			echo "<center>Remark Deleted!</center><br>";
		}
	}
}
?>
<html>
<body>
<ul>
	<a href="../Project/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
<ul>
<b><center>Audit Logs</center></b>

<?php
//reads the logs that have something written in the remarks (in other words, not empty remarks)
//if the remark is empty, the table will not show that log as there is nothing to update or delete  
$query=$connect->prepare("select * from audit_logs WHERE remarks !=''");
$query->execute();
$query->bind_result($log_ID,$date,$time,$log_details,$remarks );
echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>log_ID</th>";
echo "<th>date</th>";
echo "<th>time</th>";
echo "<th>log_details</th>";
echo "<th>remarks</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$log_ID."</td>";
	echo "<td>".$date."</td>";
	echo "<td>".$time."</td>";
	echo "<td>".$log_details."</td>";
	echo "<td>".$remarks."</td>";
	echo "<td><a href='edit.php?operation=edit&log_ID=".$log_ID."&remarks=".$remarks."'>update</a></td>";
	echo "<td><a href='readupdatedelete.php?operation=delete&log_ID=".$log_ID."'>delete</a></td>";
	echo "</tr>";	
	
}
echo "</table>";
?>

</body>
</html>
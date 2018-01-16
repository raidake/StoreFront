<?php
$connect=mysqli_connect("localhost","root","","auditor database");
?>

<html>
<body>
<ul>
	<a href="../Project/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
<ul>
<b><center>Audit Logs</center></b>

<?php
//Reads all the logs in the "audit_logs" table
$query=$connect->prepare("select * from audit_logs");
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
	echo "</tr>";	
	
}
echo "</table>";
?>

</body>
</html>
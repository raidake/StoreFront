<html>
<body>
<div>
<ul>
	<a href="../Project/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
<ul>
	<h1 style="text-align:center"> Remark Creation : </h1> <!-- create a remark for the specific log ID-->
	<form action="C.php" method="post">
			<p style ="text-align:center">Log ID: <input type="int" name="log_ID" required /> <br></p>
			<p style ="text-align:center">Remarks: <input type="text" name="remarks" required /></p>
		<p style ="text-align:center"><input type="submit" name="insert" value="create"/></p>
	</form>
</div>

<b><center>Audit Logs without remarks</center></b>

<?php
$connect=mysqli_connect("localhost","root","","auditor database");

//read the logs that have an empty remark
//this allows the user to see logs that do not have a remark, which allows for creation of remarks
$query=$connect->prepare("select * from audit_logs WHERE remarks=''");
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

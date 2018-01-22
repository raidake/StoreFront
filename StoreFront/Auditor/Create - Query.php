<html>
<body>
<div>
<ul>
	<a href="../Pdo/homepage.php"><button>Back</button></a> <!-- The [ back ] button to return to homepage-->
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

require_once("Adb.php");
//read the logs that have an empty remark
//this allows the user to see logs that do not have a remark, which allows for creation of remarks
$crud->remarklessData();

?>

</body>
</html> 

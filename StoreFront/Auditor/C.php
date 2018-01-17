<html>
<body>  
<?php
$con = mysqli_connect("localhost","root","","auditor database"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

$ilog_ID = $_POST['log_ID'];
$iremarks = $_POST['remarks'];

//updates the logs with the input log_ID by the user (ensures that the remarks is empty before allowing the update)
//if the remark is not empty, the remark that was input by the user will not be updated 
$query= $con->prepare("UPDATE audit_logs SET remarks='$iremarks' WHERE log_ID='$ilog_ID' AND remarks=''");


if ($query->execute()){  //execute query
  header("refresh:1; url=readonly.php");
}else{
  echo "Error executing query.";
}
?>



</body>
</html>
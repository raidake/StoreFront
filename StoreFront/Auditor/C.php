<?php

require_once("Adb.php");

$log_ID = $_POST['log_ID'];
$remarks = $_POST['remarks'];

//updates the logs with the input log_ID by the user (ensures that the remarks is empty before allowing the update)
//if the remark is not empty, the remark that was input by the user will not be updated 

if ($crud->create($remarks,$log_ID)){  //execute query
  header("refresh:1; url=readonly.php");
}else{
  echo "Error executing query.";
}
?>

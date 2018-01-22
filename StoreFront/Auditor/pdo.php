<?php

class crud
{
 private $db;
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 public function create($remarks,$log_ID)
 {
  try
  {
   $stmt = $this->db->prepare("UPDATE audit_logs SET remarks='$remarks' WHERE log_ID='$log_ID' AND remarks=''");
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }

  
 public function getRows()
 {

	$query = $this->db->prepare("select * from audit_logs");
	$query->execute();
	$query->bindColumn(1, $log_ID);
	$query->bindColumn(2, $date);
	$query->bindColumn(3, $time);
	$query->bindColumn(4, $log_details);
	$query->bindColumn(5, $remarks);

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
 }

 
 public function remarklessData()
 {

	$query = $this->db->prepare("select * from audit_logs WHERE remarks=''");
	$query->execute();
	$query->bindColumn(1, $log_ID);
	$query->bindColumn(2, $date);
	$query->bindColumn(3, $time);
	$query->bindColumn(4, $log_details);
	$query->bindColumn(5, $remarks);

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
 }
 

 public function updateDelete()
 {

	$query = $this->db->prepare("select * from audit_logs");
	$query->execute();
	$query->bindColumn(1, $log_ID);
	$query->bindColumn(2, $date);
	$query->bindColumn(3, $time);
	$query->bindColumn(4, $log_details);
	$query->bindColumn(5, $remarks);

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
 } 
 
 public function update($remarks,$log_ID)
 {
  try
  {
   $stmt = $this->db->prepare("UPDATE audit_logs SET remarks='$remarks' WHERE log_ID='$log_ID'");
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 
 public function delete($log_ID)
 {
  $stmt = $this->db->prepare("UPDATE audit_logs SET remarks=' ' WHERE log_ID=$log_ID");
  $stmt->execute();
  return true;
 }
}
?>
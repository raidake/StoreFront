<?php
class logs
{
 private $db;
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 public function createLogs($date,$time,$logging)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO audit_logs(date,time,log_details) VALUES('$date','$time','$logging')");
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
  

 }
}
 
?>
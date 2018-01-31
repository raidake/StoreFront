<?php

class crud
{
 private $db;
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 public function create($username, $hash, $fullname, $phonenum, $email, $address, $role)
 {
  try
  {
   $stmt = $this->db->prepare("insert into employee(username, hash, full_Name, phone_Number, email, address, role) values('$username', '$hash', '$fullname', '$phonenum', '$email', '$address', '$role');");
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

$query = $this->db->prepare("select employee_ID, username, hash, full_Name, phone_Number, email, address, role from employee");
$query->execute();
$query->bindColumn(1, $id);
$query->bindColumn(2, $username);
$query->bindColumn(3, $hash);
$query->bindColumn(4, $fullname);
$query->bindColumn(5, $phonenum);
$query->bindColumn(6, $email);
$query->bindColumn(7, $address);
$query->bindColumn(8, $role);

echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>Username</th>";
echo "<th>Hash</th>";
echo "<th>Fullname</th>";
echo "<th>Phonenum</th>";
echo "<th>Email</th>";
echo "<th>Address</th>";
echo "<th>Role</th>";
echo "</tr>";
while($query->fetch())
{
	echo "<tr>";
	echo "<td>".$id."</td>";
	echo "<td>".$username."</td>";
	echo "<td>".$hash."</td>";
	echo "<td>".$fullname."</td>";
	echo "<td>".$phonenum."</td>";
	echo "<td>".$email."</td>";
	echo "<td>".$address."</td>";
	echo "<td>".$role."</td>";
	echo "<td><a href='edit.php?operation=edit&id=".$id."&username=".$username."&hash=".$hash."&fullname=".$fullname."&phonenum=".$phonenum."&email=".$email."&address=".$address."&role=".$role."'>edit</a></td>";
	echo "<td><a href='index.php?operation=delete&id=".$id."'>delete</a></td>";
	echo "</tr>";	
	
}
echo "</table>";
 }
 
  public function update($id, $username, $hash, $fullname, $phonenum, $email, $address, $role)
 {
  try
  {
	 
   $stmt = $this->db->prepare("update employee set username='$username' , hash='$hash', full_Name='$fullname', phone_Number='$phonenum', email='$email', address='$address', role='$role' where employee_id='$id'");
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 
 public function delete($id)
 {
  $stmt = $this->db->prepare("DELETE FROM employee WHERE employee_id='$id'");
  $stmt->execute();
  return true;
 } 
 


public function sendOTP($email, $name){
$otpid=mt_rand(1000000,9999999);
$_SESSION['otpid']=$otpid;

 $stmt = $this->db->prepare("update employee set otp='$otpid' where email='$email'");
 $stmt->execute();

if(mail('$email', 'Storefront OTP','Your OTP for '.'$name'. ' is '.'$otpid')){
		 #header("location: otplogin.php");
	 }
	 else{
		 $_SESSION['message']="OTP failed. Please check email exists";
		 header("location: error.php");
	 }
}
}
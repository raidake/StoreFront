<!DOCTYPE html>

<html>
<body>

<h1 style="color:#0000FF; text-align: center">Auditing Page - Audit logs</h1>
<link rel="stylesheet" type="text/css" href="style.css">

<h2>Create a remark (for logs without a remark)<br>
<ul>
	<!-- button that leads to "Create - Query.php" which reads logs from audit_logs tablethat do not have a remark 
	and allows the user to create a remark for that log																-->
	<a href="../pdo/Create - Query.php"><button>Create</button></a>
<ul>
</h2>
<br>

<h2>Check existing logs (update or delete remarks)<br>
<ul>
	<!-- button that leads to "readupdatedelete.php" which reads logs from the audit_logs table that already have a
	 remark and allows	the user to update or delete the remark 													-->
	<a href="../pdo/readupdatedelete.php"><button>Check</button></a>
<ul>
</h2>
<br>

<h2>Check all existing logs<br>
<ul>
	<!-- button that leads to "readonly.php" which reads all the logs in the audit_logs table			 -->
	<a href="../pdo/readonly.php"><button>Check</button></a>
<ul>
</h2>
<br>

</body>
</html> 
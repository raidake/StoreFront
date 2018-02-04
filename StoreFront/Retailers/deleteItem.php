<?php
include_once 'dbconfig.php';
include_once 'sessionverify.php';
if(isset($_POST['delete']))
{
	$id = $_GET['delete_id'];
	$item_name = $_GET['item_name'];
	$crud->delete($id);
	$retails_ID =$_SESSION['retails_ID'];
	require_once('removeItemLogs.php');
	header("Location: retail_Inventory.php");
}
?>
<style type="text/css">@import "styles.css";
body {font-family: Arial;}
input[type=text]{
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 2px solid #ccc;
		box-sizing: border-box;
	}	
	input:focus { 
		outline:none;
		border-color:#9ecaed;
		box-shadow:0 0 10px #9ecaed;
	}
	.button { 
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 50%;
		left: 25%;
		position:relative;
	}
	.button1 { 
		background-color: #FF0000;
		margin: 8px 0;
		width: 50%;
	}
.container {
		padding: 50px;
		width:550px;
		margin: auto;
	}
	a {
		display:block;
		text-align:center;
	}

	</style>
<div class ="container">

	<?php
	if(isset($_GET['delete_id']))
	{
		?>
		<table align='center' border='1'>
		<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Stock</th>
		<th>Price Per Item</th>
		<th>Description</th>
		<th>Image</th>
		</tr>
		<?php
		$stmt = $DB_con->prepare("select * from retail_Items where item_ID=:id");
		$stmt->execute(array(":id"=>$_GET['delete_id']));
		while($row=$stmt->fetch(PDO::FETCH_BOTH))
		{
			?>
			<tr>
			<td><?php print($row['item_ID']); ?></td>
			<td><?php print($row['item_Name']); ?></td>
			<td><?php print($row['stock']); ?></td>
			
			<td><?php print($row['item_Cost']); ?></td>
			<td><?php print($row['item_Description']); ?></td>
			<td><img src="<?php print($row['image']); ?>" width=200 height=200 align="middle"></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
	?>
	</div>
	<div class="container">
	<p>
	<?php
	if(isset($_GET['delete_id']))
	{
		?>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
			<button type="submit" class="button" name="delete">Delete</button>
			<a href="retail_Inventory.php" style="text-decoration: none" class="button button1">Cancel</a>
		</form>
		<?php
	}
	else
	{
		?>
		<a href="retail_Inventory.php" style="text-decoration: none" class="button button1">Return</a>
		<?php
	}
	?>
	</p>
	</div>
	
	
		
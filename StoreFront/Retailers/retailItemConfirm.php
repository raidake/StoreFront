<?php
include_once 'dbconfig.php';
session_start();
if(isset($_POST['item_id']))
{
	$id = $_POST['item_id'];
	extract($crud->getID($id));
}

if(isset($_POST["value"]))
{
	$newStock = $_POST["value"];
	$id = $_POST["item_id"];
	
	if ($newStock == 0)
	{
		echo "Please select a quantity!";
		?>
		<td><a href='retailItem.php?item_id=<?php echo $_POST["item_id"]; ?>'>Return</td></a>
		<?php
	}
	else
	{
		$newStock = $stock - $newStock;
		if ($crud->buyItem($id,$newStock))
		{
			$user_id=$_SESSION['user_id'];
			$itemid=$_POST["item_id"];
			require_once('buylogs.php');
			echo "Purchase Successful!";
			echo "<a href='retail_Inventory.php' style='text-decoration: none' class='button button1'>Return</a>";
		}
	}
}

?>
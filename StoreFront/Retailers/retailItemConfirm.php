<?php
include_once 'dbconfig.php';
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
			echo "Purchase Successful!";
			echo "<a href='retail_Inventory.php' style='text-decoration: none' class='button button1'>Return</a>";
		}
	}
}

?>
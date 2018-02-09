<?php
include_once 'dbconfig.php';
include_once 'sessionverify.php';
if(isset($_POST['Update']))
{
	$item_id = $_GET['edit_id'];
	$itemname = $_POST['itemname'];
	$stock = $_POST['stock'];
	$cost = $_POST['cost'];
	$desc = $_POST['desc'];
	
	if (!empty($_FILES['image']['name']))
	{
		$upload_image=$_FILES["image"]["name"];
		$folder="/xampp/htdocs/StoreFront/Retailers/images/";
		
		move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
		$image = "./images/".$upload_image;
	}
	else
	{
		$image = NULL;
	}
	
	if($crud->updateItem($item_id,$itemname,$stock,$cost,$desc,$image))
	{
		$retails_ID=$_SESSION['retails_ID'];
		require_once('editLogs.php');
		$msg = "<div class='alert alert-info> Record was updated successfully</div>";
	}
	else
	{
		$msg = "<div class='alert alert-info> Record was not updated</div>";
	}
}
if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getID($id));
}
?>
<html>
<head>
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
</head>
<form method="post" enctype="multipart/form-data">
	<div class="container">

		<label><b>Item Name:</b></label>
		<input type="text" name="itemname" value="<?php echo $item_Name; ?>" required/>

		<label><b>Stock:</b></label>
		<input type="text" name="stock" value="<?php echo $stock; ?>" required/>

		<label><b>Cost Price:</b></label>
		<input type="text" name="cost" value="<?php echo $item_Cost; ?>" required/>

		<label><b>Item Description:</b></label>
		<input type="text" name="desc" value="<?php echo $item_Description; ?>" required/>
		
		
		<label><b>Image File:</b></label>
		<br>
		<img src="<?php echo $image; ?>" width=200 height=200 align="middle">
		<br>
		<input id="image" type="file" name="image"/>
		
		</div>
		<td align="right">
		<input type="hidden" name="item_ID" value="<?php echo $_GET['item_ID'] ?>" />
		<input type="hidden" name="update" value="yes" />
		<button type="submit" class="button" value="update Record" name="Update"/>Update Item</button>
		<br> <br>
		<a href="retail_Inventory.php" style="text-decoration: none" class="button button1">Return</a>
		
</td>


</form>
</html>
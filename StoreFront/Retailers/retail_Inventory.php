<?php
include_once 'dbconfig.php';
include_once 'sessionverify.php';
if(isset($_POST["insert"])){
		$retails_ID=$_POST["retails_ID"];
		$itemname=$_POST["itemname"];
		$stock=$_POST["stock"];
		$cost=$_POST["cost"];
		$desc=$_POST["desc"];
		$upload_image=$_FILES["image"]["name"];
		$folder="/xampp/htdocs/StoreFront/Retailers/images/";
		
		$verifyimg = getimagesize($_FILES['image']['tmp_name']);

		if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/bmp' ) {
		echo "Only images are allowed!";
		}
		else{
		move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
		$image = "/StoreFront/Retailers/images/".$upload_image;
		
		
		if($crud->createItem($retails_ID,$itemname,$stock,$cost,$desc,$image))
		{
			require_once('addItemLogs.php');
			echo "<center>Record Sent</center>";
		}
		else
		{
			echo "<center>Record Failed</center>";
		}
	}
}
?>

<html>
<head>
<style type="text/css">@import "styles.css";
	body {font-family: Arial;}
	button { 
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
	}
	
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
	.container {
		padding: 50px;
		width:550px;
		margin: auto;
	}
	table {
		border-collapse: collapse;
		width: 90%;
	}
	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
tr:hover {background-color:#f5f5f5;}
	li {
		display:inline;
		text-align: center;
		padding: 10px 20px;
		position:relative;
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
</style>
</head>

<body>
	<div style="float:right;">
		<a href="/StoreFront/Profile.php">View Profile</a>
	</div>
	<div style="float:left;">
		<a href="/StoreFront/index.php">Go to Home</a>
	</div>
	<form method="post" enctype="multipart/form-data">
		<div class="container">
		<label><b>Item Name:</b></label>
		<input type="text" placeholder="Enter Item Name" name="itemname" required>
		
		<label><b>Stock:</b></label>
		<input type="text" placeholder="Enter No. of Stock" name="stock" required/>
		
		<label><b>Item Cost:</b></label>
		<input type="text" placeholder="Enter Cost of Each Item" name="cost" required/>
		
		<label><b>Item Description:</b></label>
		<input type="text" placeholder="Enter Item Description" name="desc" required/>
		
		<label><b>Image file:</b></label>
		<input type="file" name="image" />
		<input type="hidden" value=<?php echo $_SESSION['retails_ID']; ?> name="retails_ID">
		<button type="submit" name="insert"/>Add Item</button>
		</div>
	</form>
<?php

echo "<table align='center' border='1'>";
echo "<tr>";
echo "<th>Item ID</th>";
echo "<th>Item Name</th>";
echo "<th>Stock</th>";
echo "<th>Price Per Item</th>";
echo "<th>Description</th>";
echo "<th>Image</th>";
echo "<th>Edit</th>";
echo "<th>Delete</th>";
echo "</tr>";

$key =$_SESSION['retails_ID'];
$query = "SELECT * FROM retail_items where retails_ID = '$key'";
$crud->dataview($query);
?>
</table>

</body>
</html>
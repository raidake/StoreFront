<?php
include_once "dbconfig.php";
session_start();


if(isset($_GET['item_id']))
{
	$id = $_GET['item_id'];
	extract($crud->getID($id));
}
if(isset($_POST['comment']))
{
	$comment = $_POST['comment'];
	$item_id = $_POST['item_id'];
	$user_id = $_SESSION['userid'];
	
	if($crud->addComment($comment,$item_id,$user_id))
	{ 
		$user_id = $_SESSION['userid'];
		require_once('commentAddLogs.php');
		echo "Comment successfully sent";
	}
	else
	{
		echo "Comment failed to send";
	}
	
}

?>

<html>
<head>
<style>
		header, footer {
    		padding: 1em;
    		color: white;
    		background-color: black;
    		clear: left;
    		text-align: center;
		}	
		div.layout1 {
			float: left;
			max-width: 200px;
			margin: 0;
			padding: 1em;
		}
		div.layout2 {
			margin-left: 200px;
			border-left: 0px solid gray;
			border-bottom: 5px solid black;
			padding: 1em;
			overflow: hidden;
		}
		
		div.layout3 {
			margin-left: 200px;
			border-left: 0px solid gray;
			padding: 1em;
			overflow: hidden;
			margin-bottom: 100px;
		}
		div.layout4 {
			margin-left: 200px;
			border-left: 0px solid gray;
			padding: 1em;
			overflow: hidden;
		}
		img {
			width: 200px;
			height: 200px;
		}
		label {
			font-size: 20px;
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
	</style>
<script>

function modify_qty(val) {
    var qty = document.getElementById("qty").value;
    var new_qty = parseInt(qty,10) + val;
    
    if (new_qty < 0) {
        new_qty = 0;
    }
	
	if (new_qty > <?php echo $stock; ?>)
	{
		new_qty = <?php echo $stock; ?>;
	}
    
    document.getElementById('qty').value = new_qty;
	document.getElementById('value').value = new_qty;
    return new_qty;
}

$('#qty').change(function() {
	$('#value').val($(this).val());
});
	
var d = new Date();
document.getElementbyId("date").innerHTML = d.toUTCString();
</script>
</head>
<body>

<div style="float:left;">
		<a href="/StoreFront/index.php">Go to Home</a>
</div>
<br>
<div class="layout1">
	<img src="<?php echo $image; ?>" width=200 height=200>
</div>

<div class="layout2">
	<label><?php echo $item_Name; ?></label>
</div>

<div class="layout3">
	<label><?php echo $item_Description ?></label>
	<br>
	<label>Quantity left: <?php echo $stock ?> </label>
</div>

<div class="layout4">
	<label>Price: <?php echo $item_Cost ?></label>
	<br>
	<?php 
	if(isset($_SESSION['accounttype']))
	{ 
		if($_SESSION['accounttype']!="retailer")
		{
		?>
	
	
	
	<form method="post" action="retailItemConfirm.php">
		<input type="number" name="value" id="qty" value="0" max="<?php echo $stock; ?>" min="0" />
		<input type="hidden" name="item_id" value="<?php echo $item_ID; ?>" />
		<button type="submit">Buy</button>
	</form>
	<button id="down" onclick="modify_qty(-1)" >-1</button>
	<button id="up" onclick="modify_qty(1)">+1</button>
	<?php
		}
	}
	?>
</div>

<div class="layout2">
	<label>Comments</label>
</div>

<div class="layout3">
	<?php
	if(isset($_SESSION['accounttype']))
	{ 
		if($_SESSION['accounttype'] == 'customer')
		{
			?>
	<form method="post" >
		<textarea name="comment" rows="5" cols="50" placeholder="Write your comments down in 200 characters or less..." maxlength="200" required></textarea>
		<br>
		<input type="hidden" name="item_id" value="<?php echo $item_ID; ?>" />
		<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
		<button type="submit">Submit</button>
	</form>
	
	<?php
		}
		else
		{
		?>
		<label>You need to be a customer to comment!</label>
		<?php
		}
	}
	else
	{
		?>
		<label>You need to login to comment!</label>
		<?php
	}
	
	echo "<br>";
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>User</th>";
	echo "<th>Comment</th>";
	echo "<th>Date</th>";
	echo "</tr>";
	
	$query = "SELECT * FROM comments WHERE item_ID = $item_ID ORDER BY timestamp DESC";
	$crud->viewComments($query);
	?>
	
	
</div>



</body>

</html>
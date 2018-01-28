<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function createItem($retails_ID,$itemname,$stock,$cost,$desc,$image)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO retail_items(item_Name, item_Description, item_Cost, retails_ID, stock, image) VALUES(:itemname, :desc, :cost, :retails_ID, :stock, :image)");
			$stmt->bindparam(":itemname",$itemname);
			$stmt->bindparam(":stock",$stock);
			$stmt->bindparam(":cost",$cost);
			$stmt->bindparam(":desc",$desc);
			$stmt->bindparam(":retails_ID",$retails_ID);
			$stmt->bindparam(":image",$image);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateItem($item_id,$itemname,$stock,$cost,$desc,$image)
	{
		try
		{
			
			if ($image != NULL) //if there is new image
			{
				$stmt=$this->db->prepare("update retail_items set item_Name=:itemname , item_Description=:desc, item_Cost=:cost, stock=:stock, image=:image where item_ID=:item_id");
				$stmt->bindparam(":itemname",$itemname);
				$stmt->bindparam(":stock",$stock);
				$stmt->bindparam(":cost",$cost);
				$stmt->bindparam(":desc",$desc);
				$stmt->bindparam(":item_id",$item_id);
				$stmt->bindparam(":image",$image);
			}
			else
			{
				$stmt=$this->db->prepare("update retail_items set item_Name=:itemname , item_Description=:desc, item_Cost=:cost, stock=:stock where item_ID=:item_id");
				$stmt->bindparam(":itemname",$itemname);
				$stmt->bindparam(":stock",$stock);
				$stmt->bindparam(":cost",$cost);
				$stmt->bindparam(":desc",$desc);
				$stmt->bindparam(":item_id",$item_id);
			}
			
			$stmt->execute();
			
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("update retail_Items set active=0 where item_ID=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM retail_items WHERE item_ID=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{	
				if($row['active'] == '1')
				{
				?>
						<tr>
						<td><?php print($row['item_ID']); ?></td>
						<td><a href="retailItem.php?item_id=<?php print($row['item_ID']); ?>"><?php print($row['item_Name']); ?></td></a>
						<td><?php print($row['stock']); ?></td>
						<td><?php print($row['item_Cost']); ?></td>
						<td><?php print($row['item_Description']); ?></td>
						<td><img src=<?php print($row['image']); ?> width=100 height=100></td>
						</td>
						<td align="center">
						<a href="editItem.php?edit_id=<?php print($row['item_ID']); ?>">Edit</a>
						</td>
						<td align="center">
						<a href="deleteItem.php?delete_id=<?php print($row['item_ID']); ?>">Delete</a>
						</td>
						</tr>
						
				<?php
				}		
			}
		}
			
	}
	
	public function buyItem($id,$stock)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE retail_items SET stock=:stock WHERE item_id=:id");
			$stmt->bindparam(":stock",$stock);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	public function addComment($comment,$item_id,$user_id)
	{
		try
		{
			$stmt=$this->db->prepare("insert into comments(item_ID,user_ID,comment,timestamp) values(:item_id, :user_id, :comment, NOW())");
			$stmt->bindparam(":item_id",$item_id);
			$stmt->bindparam(":user_id",$user_id);
			$stmt->bindparam(":comment",$comment);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	public function getCustomerID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM customers WHERE user_id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	public function viewComments($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$firstname = $this->getCustomerID($row['user_ID']);
				?>
					<tr>
					<td><?php print($firstname['first_Name']); ?></td>
					<td><?php print ($row['comment']); ?></td>
					<td><?php print ($row['timestamp']); ?></td>
					</tr>
				<?php
			}
			
		}
	}
}

?>


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
		$stmt = $this->db->prepare("delete from retail_Items where item_ID=:id");
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
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
			
	}
	
	public function paginglink($query,$records_per_page)
	{
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?&page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?&page_no=".$previous."'>Previous</a></li>";	
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?&page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?&page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?&page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?&page_no=".$total_no_of_pages."'>Last</a></li>";
				
			}
			?></ul><?php
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


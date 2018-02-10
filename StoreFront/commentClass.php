<?php

class crud{
	
	
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function getItemID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM retail_items WHERE item_id=:id");
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
				$item = $this->getItemID($row['item_ID']);
				?>
					<tr>
					<td><?php print($item['item_Name']); ?></td>
					<td><?php print ($row['comment']); ?></td>
					<td><?php print ($row['timestamp']); ?></td>
					</tr>
				<?php
			}
			
		}
	}
	
	
	
	
}




?>
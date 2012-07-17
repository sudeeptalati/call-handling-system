
 
<?php

//include_once ('database_connection.php');

	//echo "IN searchData<hr>";
	
	if(isset($_GET['keyword']))
	{
		//echo $_GET['keyword'];
	//}
	
		try
		{
			echo "<hr>";
				
			$db = new PDO('sqlite:master_database.db');
			
			//$keyword = trim(" flange");
			//$keyword = mysql_escape_string($keyword);
			
			$keyword = $_GET['keyword'];
			$keyword = mysql_escape_string($keyword);
			
			//$keyword = mysqli_real_escape_string($dbc, $keyword);
			//$query = "SELECT * FROM master_items WHERE name like '%$keyword%' ";
			
			$result = $db->query("SELECT * FROM master_items WHERE name like '%$keyword%' or id like '%$keyword%' or part_number like 
			'%$keyword%' or barcode like '%$keyword%' ");
			//echo "count of result = ".count($result);
			//echo "<hr>";
			
			
			//echo count($result);
			if($result)
			{
				foreach($result as $data)
				{
					echo $data['id']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo $data['part_number']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo $data['name']."<br>";
				}
			}
			else
			{
				echo "No Data available matching your search";
			}
			
		}
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}
	
	
	}
	

?>
 
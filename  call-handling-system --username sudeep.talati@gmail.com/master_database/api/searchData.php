

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With");
//$list = array();
//include_once ('database_connection.php');

	//echo "IN searchData<hr>";
	
	if(isset($_GET['keyword']))
	{
		//echo $_GET['keyword'];
	//}
		
				
			$keyword = $_GET['keyword'];
			$service_id=$_GET['service_id'];
			$keyword = mysql_escape_string($keyword);
			//echo "keyword in local = ".$keyword;
	
		try
		{
			echo "<hr>";
				
			$db = new PDO('sqlite:master_database.db');
			
			//$keyword = trim(" flange");
			//$keyword = mysql_escape_string($keyword);

			
			//$keyword = mysqli_real_escape_string($dbc, $keyword);
			//$query = "SELECT * FROM master_items WHERE name like '%$keyword%' ";
			
			$result = $db->query("SELECT * FROM master_items WHERE name like '%$keyword%' or id like '%$keyword%' or part_number like 
			'%$keyword%' or barcode like '%$keyword%'");
			 $rows = $result->fetchAll(); // assuming $result == true
			$n = count($rows);
			//echo "count od local data = ".$n;
			//echo "count of result = ".count($result);
			//echo "<hr>";
			?>
			
			<table>
			<tr>
			<th> Part Number </th>
			<th> Name </th>
			<th> ID </th>
			</tr>
			
			<?php
			
		
			
			//echo count($result);
			if($rows)
			{
				
				foreach($rows as $data)
				{
				?>
					
					<tr>
					<td><?php echo $data['part_number'];?></td>
					<td><?php echo $data['name'];?></td>
					<td><?php echo $data['id'];?></td>
					<td>
				 	<a href='../update/<?php echo $service_id;?>?cloud_id=0&master_id=<?php echo $data['id'];?>'>select me</a> <br>
					</td>
					</tr>
				 <?php
					
				}	
			}
			else
			{
				//echo "No Data available matching your search";
			}
			
			//echo "*********************CLOUD START*********************<br>";
			/**CLOUD CALCULATIONS*/
			 
			//echo $keyword."<br>";
			//echo "service id in local =".$service_id."<br>";
				
			$cloud_url="http://192.168.1.200/itemsfreesearch/searchapi.php?keyword=".urlencode($keyword)."&service_id=".$service_id;
			//$cloud_url="http://192.168.1.200/itemsfreesearch/searchapi.php?keyword=".$keyword."&service_id=".$service_id;
			//echo "<br>".$cloud_url;
			$dataResponse =curl_file_get_contents($cloud_url,true);
			echo $dataResponse;
			
			if(trim($dataResponse)=='0' && $n == 0)
			 {
				echo "no data";
				?>
				<tr>
				<td>
				<form action="<?php echo '../../SparesUsed/newItemDetails';?>" method="POST">
						<table>
						<tr>
						<td colspan="4" style="text-align:center;">
						<span style="color:green;" ><b>Add item</b><br><small>(If Item not in above list)</small></span>
						</td>
						</tr>
						
						<tr>
						<td><b>Item Name</b></td>
						<td colspan="3">
						<input type="text" name="item_name">
						</td>
						</tr>
						<tr>
						<td>
						<b>Part Number</b></td><td colspan="3"><input type="text" name="part_number">
						</td>
						</tr>
						<tr>
						<td>
						<b>Unit Price</b></td><td><input type="text" name="unit_price" size="3">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;Qty</b>&nbsp;<input type="text" name="quantity" size="3">
						</td>
						</tr>
						<tr>
						<td colspan="4">
						
						<input type="hidden" name="master_id" value="0">
						<input type="hidden" name="service_id" value="<?php echo $service_id;?>">
						<div align="center"><input value="Add" type="submit" align="middle" style="width:100px"></div>
						</td></tr>
						</table>
						</form>
				</td>
				</tr> 
			<?php
			 }//end of 
			 
			
			//echo "<br>**************************CLOUD END ***********************";
			
		}
		
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}
	}////end of if idsset keyword

?>

</table>

<?php


	
function curl_file_get_contents($request)
{
$curl_req = curl_init($request);

curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

$contents = curl_exec($curl_req);

curl_close($curl_req);

return $contents;
}///end of functn curl File get contents

?>
 
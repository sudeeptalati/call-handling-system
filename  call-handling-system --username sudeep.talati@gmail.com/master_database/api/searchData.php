

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
			//$keyword = mysql_escape_string($keyword);//to remove all special charecters.
			//echo "<br>keyword BEFORE preg_replace is called = ".$keyword;
			$keyword = preg_replace('/[^A-Za-z0-9 ]/', "", $keyword);
			//echo "<br>keyword AFTER preg_replace is called = ".$keyword;
			$keyword = strtolower(trim(str_replace (" ", "", $keyword)));
			//echo "<br>keyword AFTER removing spaces = ".$keyword;
	
	
		try
		{
			echo "<hr>";
				
			$db = new PDO('sqlite:master_database.db');
			
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
			<th>Part Number</th>
			<th>Name</th>
			<th>ID</th>
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
				 	<a href='../update/<?php echo $service_id;?>?cloud_id=0&master_id=<?php echo $data['id'];?>'>
					<img src="../../images/plus.jpg" alt="HTML tutorial" width="35" height="35" />
					</a> <br> 
					</td>
					</tr>
				 <?php
					
				}//end of foreach() displaying local db data.	
			}//end of if rows, i.e, matching data is found in local db.
			else if($n == 0)
			{
				//echo "No Data available matching your search";
				//$cloud_url="http://192.168.1.200/itemsfreesearch/searchapi.php?keyword=".urlencode($keyword)."&service_id=".$service_id;
				//$cloud_url="http://192.168.1.200/itemsfreesearch/searchapi.php?keyword=".$keyword."&service_id=".$service_id;
				
			/**********WORKING PROPERLY, COMMENTED FOR TESTING **********///$cloud_url="http://spares.rapportsoftware.co.uk/itemsfreesearch/searchapi.php?keyword=".urlencode($keyword)."&service_id=".$service_id;
			/**********WORKING PROPERLY, COMMENTED FOR TESTING **********/
			
				
				
			/************** GETTING CLOUD URL FROM DATABASE AND GETTING DATA FROM CLOUD SERVER ***************/
			
				
				$cloud_setup_id = 1;
				$get_url_result = $db->query("SELECT spares_lookup_cloud_url FROM cloud_setup WHERE id = '$cloud_setup_id'");
				$url_result = $get_url_result->fetchAll(); // assuming $result == true
				$n = count($url_result);
				//echo "<br>no of rows = ".$n."<br>";
				
				$cloud_url_from_db = '';
				foreach($url_result as $data)
				{
					//echo $data['spares_lookup_cloud_url']."<br>";
					$cloud_url_from_db = $data['spares_lookup_cloud_url'];
				}//end of foreach().
				
				
				$cloud_url = $cloud_url_from_db.'?keyword='.urlencode($keyword)."&service_id=".$service_id;
				//echo "<br> CLOUD URL GOT FROM DB = ".$cloud_url;
				
				$dataResponse =curl_file_get_contents($cloud_url,true);
				//echo "<hr>DATA OF SERVER DISPLAYING FROM LOCAL FILE <br>".$dataResponse;
				echo $dataResponse;
				
			
				
			/************** GETTING CLOUD URL FROM DATABASE AND GETTING DATA FROM CLOUD SERVER ***************/
				
			}//end of else of rows, i.e, no matching data in local db.
			
			?>
			<tr>
				<td colspan="4">
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
						</td>
					</tr>
				</table>
				</form>
				</td>
			</tr> 
			<?php
			
		}//end of try.
		
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
 
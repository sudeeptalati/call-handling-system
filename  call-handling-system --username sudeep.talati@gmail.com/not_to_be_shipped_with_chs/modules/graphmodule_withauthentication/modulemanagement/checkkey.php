<?php

$key=$_GET['key'];


$con=mysqli_connect("localhost","root","","joomla25");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
		$sql="SELECT * FROM mteqr_digistore_licenses WHERE published = 1 AND licenseid = $key";
		$que = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($que))
			{
			$n = count($row);
			$pd=$row['purchase_date'];
			$ed=$row['expires'];
			if (!$n==0)////means if key input is not found
			{
				
				$db = new PDO('sqlite:mm.db');
				
				$query="INSERT INTO modules(key,purchase_date,expiry_date,status) VALUES ('$key','$pd','$ed','0')";
				//echo $query;
				$result = $db->query($query);
				if ($result)///if insert querry is successfull
					{
					//echo "Success";
					$json_data=array ('message'=>'Key successfully inserted','result'=>array('key'=>$key,'purchase_date'=>$row['purchase_date'],',expiry_date'=>$row['expires']),'status'=>'OK'); 
					echo json_encode($json_data);
					}///end of if ($result)
			}////end of if ($n==0)
			else
			{
				$json_data=array ('message'=>'Key does not exist','status'=>'REQUEST DENIED'); 
				echo json_encode($json_data);
			}
			
		}


mysqli_close($con);
?>
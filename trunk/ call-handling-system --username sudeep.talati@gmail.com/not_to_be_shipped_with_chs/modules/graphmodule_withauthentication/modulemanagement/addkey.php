<?php

$key=$_GET['key'];
$ed=$_GET['ed'];
$status="0";
//$e_ed=$_GET['e_ed'];

//0=inactive, 1=active
$db = new PDO('sqlite:mm.db');
			
			
			$query="SELECT * FROM modules WHERE key LIKE '$key'";
			$result = $db->query($query);	
			$rows = $result->fetchAll();
			$n = count($rows);
			
			if ($n==0)////means if key input is not found
			{
			$query="INSERT INTO modules (key,expiry_date,status) VALUES ('$key','$ed','$status')";
			//echo $query;
			$result = $db->query($query);
				if ($result)///if insert querry is successfull
					{
					//echo "Success";
					$json_data=array ('message'=>'Key successfully inserted','result'=>array('key'=>$key,'ed'=>$ed,'status'=>$status),'status'=>'OK'); 
					echo json_encode($json_data);
					}///end of if ($result)
			}////end of if ($n==0)
			else
			{
				$json_data=array ('message'=>'Key already exist','status'=>'REQUEST DENIED'); 
				echo json_encode($json_data);
			}
			
			

?>
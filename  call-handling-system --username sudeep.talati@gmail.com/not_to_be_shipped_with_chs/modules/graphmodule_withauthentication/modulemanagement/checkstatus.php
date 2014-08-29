<?php
$db = new PDO('sqlite:mm.db');
$key=$_GET['key'];
$query="SELECT * FROM modules WHERE key LIKE '$key'";
$result = $db->query($query);	
$rows = $result->fetchAll();
$n=count($rows);
$status='';
$ed='';

if (!$n==0)//if input key is found
{
	foreach($rows as $r)//
	{
		$status = $r['status'];
		$ed = $r['expiry_date'];
	}///end of for each
		//  $status."<br>";
		if ($status==1)////if status is active, 1=active
		{
		
			$json_data=array ('server_status'=>'NOT_OK','message'=>'***********Key is active','status'=>'Active'); 
			echo json_encode($json_data);	
		}//end of if ($status==1)
		
		else////if status is inactive, 0=inactive
		{
			define("ENCRYPTION_KEY", $key);
			$expdate=strtotime($ed);
			$string = ($expdate.$key);
			$encrypted_string = encrypt($string, ENCRYPTION_KEY);
			$query=("UPDATE modules SET encrypted_expiry_date='$encrypted_string',status='1' WHERE key LIKE '$key'");
			$result = $db->query($query);
			$decrypted_string = decrypt($encrypted_string, ENCRYPTION_KEY);
			//echo "<hr>".$decrypted_string;
			//echo "<hr>".date('d-M-Y',$expdate);
			$json_data=array ('server_status'=>'OK','message'=>'Key is inactive','result'=>array('key'=>$key,'ed'=>$ed,'eed'=>$encrypted_string),'status'=>'Inactive','Updated Result'=>array ('message'=>'Table Updated','result'=>array('key'=>$key,'ed'=>$ed,'eed'=>$encrypted_string),'status'=>'Active')); 
			echo json_encode($json_data);

		}///end of else
	

}
else//if key not found
{
	$json_data=array ('server_status'=>'NOT_OK','message'=>'Key provided is not found','status'=>'REQUEST_DENIED'); 
	echo json_encode($json_data);
}///end of else

///encryption function
function encrypt($string, $encryption_key) 
	{
	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), $string, MCRYPT_MODE_CBC, md5(md5($encryption_key))));
	return $encrypted;
	}//end of encrypt


///decryption function
function decrypt($encrypted_string, $encryption_key) 
	{
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), base64_decode($encrypted_string), MCRYPT_MODE_CBC, md5(md5($encryption_key))), "\0");
		return $decrypted;
	}///end of decrypt


?>
<?php

$key=$_GET['key'];
////check if key exist in mm.db
$db = new PDO('sqlite:mm.db');
$query="SELECT * FROM modules WHERE key LIKE '$key'";
$result = $db->query($query);	
$rows = $result->fetchAll();
$n=count($rows);

$msg='';
$mysql_msg='';
$mysqlarray=array();
$sqlitearray=array();
$json_data=array();
if ($n==0)//
{
	///if key not found in mm.db, then we will fetch key from msql database joomla
	$msg='Key  not Found in mm.db, will search in MYSQL database';
	$mysqlarray=findkeyindigistore($key);
	if ($mysqlarray['key_found']=='OK')
	{
	$sqlitearray=insertkeyinmylocalsqlitedb($mysqlarray);
	$json_data['message']=$msg;
	$json_data['results']=$sqlitearray;
	$json_data['mysql_log']=$mysqlarray;
	}
	else
	{
	$json_data['message']="Invalid LicenseId";
	$json_data['results']="Invalid LicenseId";
	$json_data['mysql_log']="Invalid LicenseId";
	}

}
else
{
	//since key already exist in mm.db so we will not search joomla database
	$msg= "Key already exist in mm.db";
	$json_data['message']=$msg;
	$json_data['results']="Hidden";
	$json_data['status']='Request_Denied';
}
///end of if-else ($n==0)


echo json_encode($json_data);	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DEFINING ALL FUNCTIONS

////////////////////////////////////////////

function findkeyindigistore($key){

	$con=mysqli_connect("localhost","root","","joomla25");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM mteqr_digistore_licenses WHERE published = 1 AND licenseid=$key");

	
	/////Check if Key exist or not
	$row = mysqli_fetch_array($result);
	$mysql_rowcount = count($row);
	
	$mysql_msg='';
	$pd='';
	$ed='';
	$key_found='';
	if ($mysql_rowcount==0)
	{
	////KEY NOT FOUND IN MYSQL DATABASE
	$mysql_msg='KEY NOT FOUND IN MYSQL DATABASE';
	$key_found='Not Found';
	}
	else{
	//KEY FOUND IN MYSQL DATABASE AND ALSO PUBLISHED
	$key_found='OK';
	$mysql_msg='KEY FOUND IN MYSQL DATABASE AND ALSO PUBLISHED';
	$pd=$row['purchase_date'];
	$ed=$row['expires'];
	}///end of if ($mysql_rowcount==0)
	
	
	$mysqlarray=array();
	 
	$mysqlarray['mysql_message']=$mysql_msg;
	$mysqlarray['purcahse_date']=$pd;
	$mysqlarray['expiry_date']=$ed;
	$mysqlarray['key']=$key;
	$mysqlarray['status']='OK';
	$mysqlarray['key_found']=$key_found;
	mysqli_close($con);
	
	return $mysqlarray;
	
}//// end of findkeyindigistore($key);

function insertkeyinmylocalsqlitedb($mysqlarray)
{
	$output=array();
	/////GENERATE THE ENCRYPTED KEY
	$ed_int = strtotime($mysqlarray['expiry_date']);
	$pd=$mysqlarray['purcahse_date'];
	$ed=$mysqlarray['expiry_date'];
	$key=$mysqlarray['key'];
	$string = $ed_int.$key;
	$encrypted_expiry_date=encrypt($string,$key);
	//echo $encrypted_expiry_date;
	
	///insert key, encrypted_expiry_date, expiry_date, purchase_date into mm.db
	$db = new PDO('sqlite:mm.db');
	$query="INSERT INTO modules(key,encrypted_expiry_date,purchase_date,expiry_date,status) VALUES ('$key','$encrypted_expiry_date','$pd','$ed','0')";
	$result = $db->query($query);
	
	if ($result)///if insert querry is successfull
	{				
		$output['key']=$key;
		$output['encrypted_expiry_date']=$encrypted_expiry_date;
		$output['purchase_date']=$pd;
		$output['expiry_date']=$ed;
		$output['sqlite_msg']= "Key Successessfully inserted";
		$output['status']='OK';
	}///end of for each
	else {
		$output['sqlite_msg']= "ERROR IN INSERTING KEY in SQLITE DATABASE MM.db";
		$output['status']='Request_Denied';
	}
	
	return $output;
}////end of insertkeyinmylocalsqlitedb($mysqlarray)

function encrypt($string, $encryption_key) 
{
	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), $string, MCRYPT_MODE_CBC, md5(md5($encryption_key))));
	return $encrypted;
}//end of encrypt


?>
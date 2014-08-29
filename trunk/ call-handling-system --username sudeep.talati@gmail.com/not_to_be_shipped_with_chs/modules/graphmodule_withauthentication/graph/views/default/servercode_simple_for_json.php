<?php
$key='111111'; ///The length should be always 5 charecters
$status='active';
$ed='20-05-2017';
////You need to encrypt this date with the key

if(isset($_POST['key']))
{
$k = $_POST['key'];

$e=Graph::model()->loadjson();
$e['key']=$k;

print_r($e);
$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
$file= $url.'\graph.json';
//file_put_contents($file,$e); 



echo "key inserted";
}
define("ENCRYPTION_KEY", $key);
//Step 1: Convert date to Int
$expdate=strtotime($ed);
echo '<br><br><br><hr>'.$ed;
//Step 2: add the key at last eg :1010100.$key
$string = ($expdate.$key);
echo $string;
///Step 3: Encrypt the string with the key

$encrypted_string = encrypt($string, ENCRYPTION_KEY);
echo ($encrypted_string."<br>");

$decrypted_string = decrypt($encrypted_string, ENCRYPTION_KEY);
echo ($decrypted_string."<br>");


function encrypt($string, $encryption_key) {

   $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), $string, MCRYPT_MODE_CBC, md5(md5($encryption_key))));
	
	return $encrypted;

}//end of encrypt

function decrypt($encrypted_string, $encryption_key) {

	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), base64_decode($encrypted_string), MCRYPT_MODE_CBC, md5(md5($encryption_key))), "\0");
	
	return $decrypted;
}//end of decrypt



?>
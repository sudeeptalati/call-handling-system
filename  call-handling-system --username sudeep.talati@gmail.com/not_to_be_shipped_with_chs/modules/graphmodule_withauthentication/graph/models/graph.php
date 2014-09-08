<?php
class Graph extends CActiveRecord
{
public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

   

    public function sayHello()
    { 
         echo "hello world";
    }
	
	public function decrypt($encrypted_string, $encryption_key) 
	{
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), base64_decode($encrypted_string), MCRYPT_MODE_CBC, md5(md5($encryption_key))), "\0");
		return $decrypted;
	}///end of decrypt
	
	public function encrypt($string, $encryption_key) {

   $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encryption_key), $string, MCRYPT_MODE_CBC, md5(md5($encryption_key))));
	
	return $encrypted;

	}//end of encrypt
	public function loadjson()
		 {
			$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
			//echo $url.'/graph.json';
			$string = file_get_contents($url.'/graph.json');
			//echo $string;
			$json_a=json_decode($string,true);
			//print_r ($json_a);
			return $json_a;
			
		 }///end of loadjson
		 
	
	
	public function file_put_contents_deep( $file, $data)
	{
		if ($data['results']['status']=='OK')
		{
			$ob_key=$data['results']['key'];
			//echo '<hr>OB KEY IS '.$ob_key;
				
			$eed=$data['results']['encrypted_expiry_date'];
			//echo '<hr>OB KEY IS '.$eed;
			
			$ed=$data['results']['expiry_date'];
			//echo '<hr>OB KEY IS '.$ed;
			
			$pd=$data['results']['purchase_date'];
			//echo '<hr>OB KEY IS '.$pd;
			/////
			//echo "<hr>".$file;
			
			$e=$this->loadjson();

			//echo '<hr>';
			//print_r($e);
			$e['key']=$ob_key;
			$e['status']='1';
			$e['expiry_date']=$ed;
			$e['encrypted_expiry_date']=$eed;
			$e['purchase_date']=$pd;
			//echo '<hr>';
			
			$e=json_encode($e);
			//print_r($e);
			file_put_contents($file,$e); 
		}//end of if serverstatusok
		
	}///end of file_put_contents_deep
	
	
	
	
	
	
	/*TO DECODE THE CONETENTS DOWNLOADED FROM URL*/
	public function curl_file_get_contents($request)
	{
		$curl_req = curl_init($request);


		curl_setopt($curl_req, CURLOPT_URL, $request);
 		curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

		$contents = curl_exec($curl_req);

		curl_close($curl_req);

		return $contents;
	}///end of functn curl File get contents
	
}


?>
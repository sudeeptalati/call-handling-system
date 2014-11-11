<?php

$username=$_POST["email"];
$pwd= hash('sha256', $_POST["pwd"]);
$json_array=array();///declaring a blank array 

///checking the record in engineer model
if($model=Engineer::model()->findByAttributes(array('engineer_email'=>$username,'pwd'=>$pwd)))
{
	//$this->redirect('index.php?r=site/index');
	$json_array['engineer_email']=$model->engineer_email;
	$json_array['exp_date']=$model->exp_date;
	$json_array['engineer_id']=$model->id;
	$json_array['status']='OK';
	$exp_date_time=strtotime($json_array['exp_date']);
	$e= json_encode(array($json_array));	
	if ($exp_date_time > time())///checking if account is expired
	{
		echo $e;
	} ///end of if account is expired
	else
	{
		echo json_encode(array('status'=>'ACCOUNT_EXPIRED'));
	}/// end of else
	
}//end of if the record in engineer model
else
{
	echo json_encode(array('status'=>'INVALID_LOGIN'));
}///end of else the record in engineer model

?>

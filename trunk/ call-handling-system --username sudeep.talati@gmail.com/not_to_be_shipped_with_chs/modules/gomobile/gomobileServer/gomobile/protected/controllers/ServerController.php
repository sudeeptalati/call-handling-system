<?php

class ServerController extends Controller
{
	public function actionIndex()
	{
	header("Access-Control-Allow-Origin: *");
	$d=$_POST['jsonData'];
	//$d='{"Details":[{"id":"27422","servicecall_number":"125685","engineer_id":"90000000","servicecall":{"service_reference_number":"125685","fault_description":"installation fail","fault_date":"1410300000","product_id":"22207","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27423","servicecall_number":"125686","engineer_id":"564","servicecall":{"service_reference_number":"125686","fault_description":"installation fail","fault_date":"1410300000","product_id":"22208","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27424","servicecall_number":"125687","engineer_id":"435","servicecall":{"service_reference_number":"125687","fault_description":"installation failed","fault_date":"1410300000","product_id":"22208","job_finished_date":"","customer|town":"dewas"},"customer":{"name":" Purva"}},{"id":"27425","servicecall_number":"125688","engineer_id":"403","servicecall":{"service_reference_number":"125688","fault_description":"installation failed","fault_date":"1410300000","product_id":"22209","job_finished_date":"","customer|town":"SWINDON"},"customer":{"name":" Purva"}}]} ';
	
	$servicecalls=array();
	$r=(array)json_decode($d, true); 
	
	
	foreach($r as $value)
	{
		
		foreach ($value as $p)
		{
		$x=array();
		
		$service_reference_number=$p['service_reference_number'];
		
		$model=new EngineerData;
		$model->engineer_email=$p['engineer_email'];
		$x['service_reference_number']=$service_reference_number;
		$x['engineer_email']=$p['engineer_email'];
		$x['data']=$p['servicecall'];
		$model->data=json_encode($x);
		
		
		//echo $x;
		//print_r($p['servicecall']);
		//$model=new EngineerData;
		//$model->engineer_id=$r['Details'][0]['engineer_id'];
		//$model->data=$r['Details'][0]['servicecall']['fault_description'];
		//echo $model->data;
		$model->save();
		array_push($servicecalls,$service_reference_number);
		
		}///end of foreach ($value as $p)
	}///end iof foreach($r as $value)
	
	
	echo json_encode($servicecalls);
	}///end of  actionIndex
	
	
	
	
	
	
	
	////////creating function getmyenggdetails
	public function actiongetmyenggdetails()
	{
	$engineer_email=$_GET['engineer_email'];
	$engineer_model=EngineerData::model()->findAllByAttributes(array('engineer_email'=>$engineer_email));
	$myarray=array();
	
	foreach ($engineer_model as $data)
		{
		//echo $data->data;
			
		array_push($myarray,json_decode($data->data));
		}
		
		
	$details=json_encode(array($myarray));
	echo $details;
	}
	/////end of getmyenggdetails
		
}
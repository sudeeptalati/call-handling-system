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
		$model=new EngineerData;
		$model->engineer_id=$p['engineer_id'];
		$x=json_encode($p['servicecall']);
		array_push($servicecalls,$p['servicecall']['service_reference_number'] );
		$model->data=$x;
		//echo $x;
		//print_r($p['servicecall']);
		//$model=new EngineerData;
		//$model->engineer_id=$r['Details'][0]['engineer_id'];
		//$model->data=$r['Details'][0]['servicecall']['fault_description'];
		//echo $model->data;
		$model->save();
		}///end of foreach ($value as $p)
	}///end iof foreach($r as $value)
	
	
	echo json_encode($servicecalls);
	}///end of  actionIndex
	
	
	
	
	
	
	
	////////creating function getmyenggdetails
	public function actiongetmyenggdetails()
	{
	$id=$_GET['engineer_email'];
	$engineer_model=EngineerData::model()->findAllByAttributes(array('engineer_id'=>$id));
	$myarray=array();
	
	foreach ($engineer_model as $data)
		{
		//echo $data->data;
			
		array_push($myarray,json_decode($data->data));
		}
		
		
	$details=json_encode($myarray);
	echo $details;
	}
	/////end of getmyenggdetails
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
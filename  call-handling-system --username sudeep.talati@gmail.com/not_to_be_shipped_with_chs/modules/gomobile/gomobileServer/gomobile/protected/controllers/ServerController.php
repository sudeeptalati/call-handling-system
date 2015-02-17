<?php

class ServerController extends Controller
{
	public function actionIndex()
	{
		$status="OK";
		$status_message="Server is working fine";
		echo json_encode(array('status'=>$status,'status_message'=>$status_message));
		}///end of index
	
	public function actionGetdatafromodule()
	{		
		header('Access-Control-Allow-Origin: *');
		$datareceived=$_POST['jsonData'];
	
		//$datareceived=' {"Details":[{"service_reference_number":"127550","gomobile_sentcall_id":"29287","visit_start_date":"1421913600","visit_end_date":"1421917200","gomobile_account_id":"Sudeep","engineer_email":"sweetpullo@gmail.com","customer_fullname":" kenny","customer_postcode":"m22 4ng","customer_address":"2 Royle Green Road   Manchester m22 4ng","servicecall":{"Customer":" kenny","Postcode":"m22 4ng","Model":"AWB510L","Type":"Washing Machine","Fault":"drum stopped spinning, has checked filter, \r\nis aware call chargeable if not a manufacturing fault or NFF\r\n****can you get the 14 digit number starting 114****","Appointment Date":"22-Jan-2015","Brand":"Amica"},"customer":{"name":" kenny","postcode":"m22 4ng"}}]}';
		$servicecalls=array();
		$sent_servicecalls=array();
		$unsent_servicecalls=array();
		
		$datareceived_array=(array)json_decode($datareceived, true); 
		
		foreach($datareceived_array as $datareceived_array_value)
		{
			
			foreach ($datareceived_array_value as $p)
			{
				$service_reference_number=$p['service_reference_number'];	
				$engineer_email=$p['engineer_email'];
				
				if($this->ifengineeremailexists($engineer_email))//calling function
				{
					$model=new EngineerData;
					$model->engineer_email=$engineer_email;
					$x=array();
					$x['service_reference_number']=$service_reference_number;
					$x['engineer_email']=$engineer_email;
					$x['gomobile_account_id']=$p['gomobile_account_id'];
					$x['customer_fullname']=$p['customer_fullname'];
					$x['customer_postcode']=$p['customer_postcode'];
					$x['visit_start_date']=$p['visit_start_date'];
					$x['visit_end_date']=$p['visit_end_date'];
						
					$x['data']=$p['servicecall'];
					$model->data=json_encode($x);
					$model->data_status_id='1';///since 1 is recvd from CHS
					$model->gomobile_account_id=$p['gomobile_account_id'];
					$ar=array();
					if($model->save())
						{
						$ar['service_reference_number']=$service_reference_number;
						$ar['message']='Servicecall Sent To Mobile';
						}///end of if $model->save
					else
						{
						$ar['service_reference_number']=$service_reference_number;
						$ar['message']='Servicecall cannot be saved on the server. Please try again.';
						}///end of else $model->save
						
					array_push($sent_servicecalls,$ar);	
				}///end of ifengineeremailexists
				else
				{	
					$ar=array();
					$ar['service_reference_number']=$service_reference_number;
					$ar['message']='Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk';

					array_push($unsent_servicecalls,$ar);	
				}///end of else ifengineeremailexists
			}///end iof foreach($datareceived_array_value as $p)
			
			$servicecalls['unsent_servicecalls']=$unsent_servicecalls;
			$servicecalls['sent_servicecalls']=$sent_servicecalls; 
			echo json_encode($servicecalls);
		}///end of foreach ($datareceived_array as $datareceived_array_value)
		
	}///end of  actionIndex
	
	////////creating function Getengineerdataformobile
	public function actionGetengineerdataformobile()
	{
	
		
		$engineer_email=$_GET['engineer_email'];
		$engineer_pwd=$_GET['pwd'];
		$myarray=array();
		$status="";
		$status_message="";
		if($this->verifyengineer($engineer_email,$engineer_pwd))
		{
		$engineer_model=EngineerData::model()->findAllByAttributes(array('engineer_email'=>$engineer_email,'data_status_id'=>'1'));
		$totalrecords=count($engineer_model);
		
			if ($totalrecords==0)
				{
				$status="NO_CALLS";
				$status_message='No Calls Available';
				}
			else
				{
				foreach ($engineer_model as $data)
					{
					array_push($myarray,json_decode($data->data));
					$this->deleteengineerdatarecord($data->id);
					}///end of foreach $engineer_model as $data
				$status='OK';
				$status_message='Calls Received successfully';	
				}
			
				echo json_encode(array('details'=>$myarray, 'status'=>$status, 'status_message'=>$status_message));
		}////end of if verifyengineer
		else
		{	
			//$status="FAILED";
			//$status_message="INVALID ENGINEER";
			echo json_encode(array('status'=>'INVALID ENGINEER','status_message'=>'The email or password is incorrect. '));
		}///end of else verifyengineer
	}/////end of actionGetengineerdataformobile
	
	public function actionGetdatafrommobile()
	{
		$status="";
		$status_message="";
		$engineer_email=$_GET['engineer_email'];
		$engineer_pwd=$_GET['pwd'];
		if($this->verifyengineer($engineer_email,$engineer_pwd))
		{
			$getdata=$_POST['data'];
			//$getdata='[{"gomobile_account_id":"Sudeep","service_reference_number":127548,"work_carried_out":"{\"report_findings\":\"2bsd\",\"workdone\":\"\",\"parts\":[]}","images":"{\"findings\":\"NOIMAGE\",\"product\":\"NOIMAGE\",\"no_access\":\"NOIMAGE\",\"other\":\"NOIMAGE\"}"},{"gomobile_account_id":"Sudeep","service_reference_number":127550,"work_carried_out":"{\"report_findings\":\"\",\"workdone\":\"\",\"parts\":[]}","images":"{\"findings\":\"NOIMAGE\",\"product\":\"NOIMAGE\",\"no_access\":\"NOIMAGE\",\"other\":\"NOIMAGE\"}"}]';
			$datareceived_array=(array)json_decode($getdata, true); 
			$status="OK";
			$status_message='Saving Servicecalls: Ref Nos#';
			
			foreach($datareceived_array as $datareceived_array_value)
			{
				$model=new EngineerData;
				$model->engineer_email=$engineer_email;
				$model->gomobile_account_id=$datareceived_array_value['gomobile_account_id'];
				$model->data=json_encode($datareceived_array_value);
				$model->data_status_id=3;
				if($model->save())
				{
					$status_message=$status_message.' '.$datareceived_array_value['service_reference_number'].', ';
				}//end of if model save
				else
				{
					$status="FAILED";
					$status_message=$status_message.'NOT SAVED :'.$datareceived_array_value['service_reference_number'].', ' ;
				}///end of else
			}	
				
				
			//print_r($datareceived_array);
			//$gomobile_account_id=$datareceived_array[0]['gomobile_account_id'];
			
			
			echo json_encode(array('status'=>$status,'status_message'=>$status_message));
		}///end of if verifyengineer
		else
		{
			echo json_encode(array('status'=>'FAILED','status_message'=>' The username or password is incorrect. Please try again.'));
		}///end of else verifyengineer
	}///end of actiongetdatafrommobile

	
	public function actionGetdatafordesktop()
	{
	header('Access-Control-Allow-Origin: *');
	
	$engineer_emails=$_GET['engineer_emails'];
	$gomobile_account_id=$_GET['gomobile_account_id'];
	$new_array=array();
/*
	echo '<br> gomobile_account_id EMAIL SO N SERVE '.$gomobile_account_id	;		
	echo '<br> RECIEBEVD EMAIL SO N SERVE '.	$engineer_emails;
*/
	foreach ($engineer_emails as $engg_email)
	{
		//echo '<br> ARRAY  EMAIL SO N SERVE '.$engg_email	;
		$engineer_data_model=EngineerData::model()->findAllByAttributes(array('data_status_id'=>'3', 'engineer_email'=>$engg_email, 'gomobile_account_id'=>$gomobile_account_id));
		
		foreach($engineer_data_model as $data)
		{
		//echo '<br> ARRAY  EMAIL SO N SERVE '.§$data->data	;
		array_push($new_array,json_decode($data->data));
		$this->deleteengineerdatarecord($data->id);
		
		}
		
		
	}
	/*
		$engineer_data_model=EngineerData::model()->findAllByAttributes(array('data_status_id'=>'3'));
	*/
	echo json_encode($new_array);
	
	
	
	}///end of actionGetdatafordesktop
	
	
	
	public function actionUploadimagefromotherdevice()
	{
	header('Access-Control-Allow-Origin: *');
	
	$status="";
	$status_message="";
	$engineer_email=$_GET['engineer_email'];
	$engineer_pwd=$_GET['pwd'];

	if($this->verifyengineer($engineer_email,$engineer_pwd))
	{
		$target = "imagesfrommobile/";
		$target = $target . basename( $_FILES['media']['name']) ;
		$ok=1;
		if(move_uploaded_file($_FILES['media']['tmp_name'], $target))
		{
			//echo "The file ". basename( $_FILES['media']['name']). " has been uploaded";
			$status="OK";
			$status_message="The file ". basename( $_FILES['media']['name']). " has been uploaded";
		}
		else {
			$status="FAILED";
			$status_message="Sorry, there was a problem uploading your file.";
		}
	}else///END OF if($this->verifyengineer($engineer_email,$engineer_pwd))
	{
		$status="INVALID_LOGIN";
		$status_message="The username or password is incorrect.";
	}
		
		echo json_encode(array('status'=>$status,'status_message'=>$status_message));
	}///end of public function actionUploadimagefromotherdevice()
	
	
	
	public function deleteengineerdatarecord($id)
	{	
		if($engineer_data_model=EngineerData::model()->findByPk($id))
		{
			if($engineer_data_model===null)
			{
			throw new CHttpException(404,'The requested page does not exist.');
			}
			$engineer_data_model->delete();
			return true;
		}
		else
			return false;
	}////end of deleteengineerdatarecords
	
	public function verifyengineer($engineer_email,$engineer_pwd)
	{
		if (Engineer::model()->findByAttributes(array('engineer_email'=>$engineer_email,'pwd'=>$engineer_pwd)))
			return true;
		else
			return false;
	}//end of verifyengineer
	
	public function ifengineeremailexists($engineer_email)
	{
		if (Engineer::model()->findByAttributes(array('engineer_email'=>$engineer_email)))
			return true;
		else
			return false;
	}
	
}
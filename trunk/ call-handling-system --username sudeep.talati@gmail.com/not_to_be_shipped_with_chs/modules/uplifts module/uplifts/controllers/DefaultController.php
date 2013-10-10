<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSearchServicecall()
	{
		$servicecall_id=$_GET['servicecall_id'];
		
		///echo "********* <br>".$servicecall_id;
		$servicecall=Servicecall::model()->findByAttributes(array('service_reference_number'=>$servicecall_id));
	
		$result_array=array();
		
		//print_r($servicecall);
		if ($servicecall)
		{		
			$result_array['searchstatus']='1';
			$result_array['searchstatustext']='Found';
			$result_array['fault_description']=$servicecall->fault_description;
			$result_array['customer_id']=$servicecall->customer->id;
			$result_array['customer_name']=$servicecall->customer->fullname."\n".$servicecall->customer->town.",  ".$servicecall->customer->postcode;
			$result_array['customer_town_postcode']=$servicecall->customer->town.",  ".$servicecall->customer->postcode;
			
			
			
			$result_array['product_id']=$servicecall->product_id;
			
			$result_array['productType_id']=$servicecall->product->productType->id;
			$result_array['productType_name']=$servicecall->product->productType->name;
			$result_array['product_model_number']=$servicecall->product->model_number;	
			$result_array['product_serial_number']=$servicecall->product->serial_number;
			$result_array['product_index_number']=$servicecall->product->enr_number;
			$result_array['product_date_of_purchase']=date('d-m-Y',$servicecall->product->purchase_date);
 			$result_array['product_retailer']=$servicecall->product->purchased_from;
			$result_array['product_distributor']=$servicecall->product->distributor;
						
			$result_array['visited_engineer_name']=$servicecall->product->engineer->fullname;
			$result_array['visited_engineer_id']=$servicecall->product->engineer->id;
			
 
			 
			 
			 
		
			$result_json= json_encode($result_array);
			echo json_encode($result_array);	
			 
		}
		
		
	}
	
	
}
<?php

class ReportsController extends Controller
{
	public function actionForm()
	{
		$serviceacall_model=new Servicecall();
	
		
		$active_data=new CActiveDataProvider($serviceacall_model, array(
						'criteria'=>array('condition'=>'id=0'),
						//'pagination'=>false,
						'sort'=>array(
							'defaultOrder'=>'service_reference_number DESC',
							),
					));
		
		 
		
		
		if(isset($_GET['generate_report']))
			{
				echo '***********************';
				echo '<br> Engg ID is :'.$_GET['engineer_id'];
				echo '<br> Status ID is :'.$_GET['job_status_id'];
				
				$criteria=new CDbCriteria();
				
				$criteria->compare('job_status_id',$_GET['job_status_id']);
				$criteria->compare('engineer_id',$_GET['engineer_id']);
				
						
				if ($_GET['fault_dateStartDate']!='')
				{
					$fault_dateStartDate=strtotime($_GET['fault_dateStartDate']);
					$fault_dateEndDate=strtotime($_GET['fault_dateEndDate']);
					$criteria->addBetweenCondition('fault_date', $fault_dateStartDate, $fault_dateEndDate);
				}
				
				if ($_GET['jobPaymentStartDate']!='')
				{
					$jobPaymentStartDate=strtotime($_GET['jobPaymentStartDate']);
					$jobPaymentEndDate=strtotime($_GET['jobPaymentEndDate']);
					
					echo '<br> job PAYMENT START DATE : '.$jobPaymentStartDate;
					echo '<br> job PAYMENT END DATE : '.$jobPaymentEndDate;
					$criteria->addBetweenCondition('job_payment_date', $jobPaymentStartDate, $jobPaymentEndDate);
				}
				
				
				if ($_GET['jobFinishedStartDate']!='')
				{
					$jobFinishedStartDate=strtotime($_GET['jobFinishedStartDate']);
					$jobFinishedEndDate=strtotime($_GET['jobFinishedEndDate']);
					$criteria->addBetweenCondition('job_finished_date', $jobFinishedStartDate, $jobFinishedEndDate);
				}

				echo '<br> SERVICECALLS WITH STATUS	:	'.$serviceacall_model->count($criteria);
				$data=Servicecall::model()->find($criteria);
				//print_r($data);
				
				$active_data=new CActiveDataProvider($serviceacall_model, array(
						'criteria'=>$criteria,
						//'pagination'=>false,
						'sort'=>array(
							'defaultOrder'=>'service_reference_number DESC',
							),
					));
					
	
			}///end of if(isset($_GET['generate_report']))
			
			$this->render('form',array('model'=>$serviceacall_model, 'active_data'=>$active_data));
	
	}///end of form

	
	
	
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
<?php

class EnggdiaryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ICalLink','ChangeEngineerOnly','admin','create','update','ChangeEngineer','ChangeAppointment','WeeklyReport'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','displayDiary'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$service_id=$_GET['id'];
		$engg_id=$_GET['engineer_id'];
		
		
		//echo "THIS IS SELECTED :".$engg_id;
		//echo "<hr>SEVRICE CALL ID :".$service_id;
		$model=new Enggdiary;
		$model->servicecall_id=$service_id;
		$model->engineer_id=$engg_id;
		$model->status='3';//STATUS OF APPOINTMENT(VISIT START DATE).
		//echo "THIS IS SELECTED :".$model->engineer_id;
		
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			
			if($model->save())
			{
				$seviceQueryModel=Servicecall::model()->findByPk($service_id);
				$serviceModel=Servicecall::model()->updateByPk($seviceQueryModel->id,
													array('job_status_id'=>'3')	
													);
				$service_id=$model->servicecall_id;
        		$engg_id=$model->engineer_id;
	        	
				$baseUrl=Yii::app()->request->baseUrl;
				$this->redirect($baseUrl.'/servicecall/'.$service_id);
			}
		
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Enggdiary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Enggdiary('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Enggdiary']))
			$model->attributes=$_GET['Enggdiary'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Enggdiary::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='enggdiary-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}//end of ajax.
	

	
	
	public function actionChangeEngineer()
	{
		
		$model=new Enggdiary();
		
		if (isset($_GET['engineer_id']))
		{
			
		$model->engineer_id=$_GET['engineer_id'];
		//echo "ENGINEER ID IN CONTROLLER :".$model->engineer_id;
		}
	    
		if(isset($_POST['Enggdiary']))
    	{
        $model->attributes=$_POST['Enggdiary'];
        //echo "I M INSIDE AND id is ".$model->engineer_id;
        if ($model->servicecall_id)
        	{
//			if($model->save())
//			{
	        	$service_id=$model->servicecall_id;
	        	$engg_id=$model->engineer_id;
	        	
				$baseUrl=Yii::app()->request->baseUrl;
				$this->redirect($baseUrl.'/enggdiary/create/'.$service_id.'?engineer_id='.$engg_id);
        	}	

    	}//
    
		$this->render('changeEngineer',array(
			'model'=>$model,
		));
    	
    
	}
///end of function change engineer	
	
	public function actionChangeAppointment()
	{
		$service_id=$_GET['service_id'];
	    $engg_id=$_GET['engineer_id'];
	    
	//    echo "<br>EWNDF I D ID ".$engg_id;
		$diaryid=$_GET['enggdiary_id'];
		//echo "diary id in controller :".$diaryid;		
	    $model=$this->loadModel($diaryid);
	    $model->engineer_id=$engg_id;
	    //$model->servicecall_id=$service_id;
	    $model->id=$diaryid;
	    
	    if(isset($_POST['Enggdiary']))
	    {
			$model->attributes=$_POST['Enggdiary'];

		//	echo 'SERVICE CLAL ID ids '.$model->servicecall_id;
			$servicecall_model=Servicecall::model()->findByPk($model->servicecall_id);
			$current_engg_diary_id=$servicecall_model->engg_diary_id;
			//echo '<br>Current Fdiary id :'.$current_engg_diary_id;
		    Enggdiary::model()->updateByPk($current_engg_diary_id,
														array(
														'status'=>'11',//change old appointment status to Cancelled.
														)
												);
	    												
	    	/*CREATING A NEW MODEL HERE */												
	    	$newmodel=new Enggdiary;
			$newmodel->servicecall_id=$model->servicecall_id;;
//				echo '<br> NEW ENGG ID ID '.$model->engineer_id;
			$newmodel->engineer_id=$model->engineer_id;;
		
			$newmodel->attributes=$_POST['Enggdiary'];
			$newmodel->status='3';
			
			//echo 'SERVICECALL ID'.$newmodel->servicecall_id;
			
			if ($newmodel->save())
			{
		 		$new_diary_model=Enggdiary::model()->findByAttributes(
		 																array(
		 																'servicecall_id'=>$newmodel->servicecall_id,
		 																'status'=>3,
		 																)
		 															);				
			//	echo 'Engg Diary Id'. $new_diary_model->id;		 															
		    	Servicecall::model()->updateByPk($new_diary_model->servicecall_id,
														array(
														'engg_diary_id'=>$new_diary_model->id,
														'engineer_id'=>$new_diary_model->engineer_id,														
														)
												);
				
				
				
				
				$baseUrl=Yii::app()->request->baseUrl;
				$this->redirect($baseUrl.'/servicecall/'.$new_diary_model->servicecall_id);
			
			
			}
			else 
			{
				echo "AWW";
			}
			
	    }//end of if(isset());
	    $this->render('changeAppointment',array('model'=>$model));
	}//END OF CHANGE appointment.
	
	public function actionChangeEngineerOnly($id)
	{
		
		$model=$this->loadModel($id);
		
		if(isset($_POST['Enggdiary']))
    	{
        $model->attributes=$_POST['Enggdiary'];
        if ($model->servicecall_id)
        	{
        	$service_id=$model->servicecall_id;	
        	$engg_id=$model->engineer_id;
//
//      	 	 echo "I M INSIDE AND id is ".$model->engineer_id;
//      	   	 echo "<br> SERVICE ".$model->servicecall_id;
//      	     echo "Diary ID".$id;
      	           	
			$baseUrl=Yii::app()->request->baseUrl;
			$this->redirect($baseUrl.'/enggdiary/ChangeAppointment/?serviceId='.$service_id.'&engineerId='.$engg_id.'&enggdiary_id='.$id);
			//$this->redirect($baseUrl.'/enggdiary/create/'.$service_id.'?engineer_id='.$engg_id);
        	}	

    	}//
	
	}//end of function change engineer Only
	
	public function actionWeeklyReport()
	{
		
		$model=new Enggdiary('view');
		
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='enggdiary-weeklyReport-form')
		{
			echo CActiveForm::validate($model);
		    Yii::app()->end();
		 }
		 */
		
		 if(isset($_POST['Enggdiary']))
		 {
		 	$model->attributes=$_POST['Enggdiary'];
		    if($model->validate())
		    {
		    	// form inputs are valid, do something here
		        return;
		     }
		 }
		 $this->render('weeklyReport',array('model'=>$model));
	}//end of function weeklyReport().
	
	
	public function actionICalLink($id)
	{
		$serviceModel = Servicecall::model()->findByPk($id);
		$str = $serviceModel->customer->address_line_1." ".$serviceModel->customer->address_line_2." ".$serviceModel->customer->address_line_3;
		$str1 = $serviceModel->customer->town;
		$str2 = $serviceModel->customer->postcode_s." ".$serviceModel->customer->postcode_e;
		$address = $str." \t "."Town :".$str1." \t "."Postcode :".$str2;
		$visit_date = date('Ymd',$serviceModel->enggdiary->visit_start_date);
		
		$date      = $visit_date;
$startTime = $visit_date;
$endTime   = $visit_date;
$subject   = 'hi';
$desc      = 'Customer Details'.
			 '\n Name - '.$serviceModel->customer->fullname.
			 '\n Address - '.$address.
			 '\n Telephone - '.$serviceModel->customer->telephone."\t".'Mobile :'.$serviceModel->customer->mobile.
			 '\n Email - '.$serviceModel->customer->email.
			 '\n\n Product Details'.
			 '\n Brand - '.$serviceModel->product->brand->name.
			 '\n Product - '.$serviceModel->product->productType->name.
			 '\n Model - '.$serviceModel->product->model_number.
			 '\n\n Fault Details'.
			 '\n Fault Description - '.$serviceModel->fault_description.
			 '\n Fault report date - '.date('d-M-y', $serviceModel->fault_date);
		 
$ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "example.com
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:".$date."T".$startTime."00Z
DTEND:".$date."T".$endTime."00Z
SUMMARY:".$subject."
DESCRIPTION:".$desc."
END:VEVENT
END:VCALENDAR";
 
//set correct content-type-header
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=calendar.ics');
echo $ical;
exit;


		
	}///end of function ICalLink
	
	
}//end of class.

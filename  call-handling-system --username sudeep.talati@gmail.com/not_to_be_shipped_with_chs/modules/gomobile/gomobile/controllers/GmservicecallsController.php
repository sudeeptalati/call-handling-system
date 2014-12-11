<?php

class GmservicecallsController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','Servicecallreceivedfromgomobileserver','receivedcalls'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','servicecallsenttogomobileserver','receiveservicecallfrommobile','receivedcalldetails'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new GmServicecalls;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GmServicecalls']))
		{
			$model->attributes=$_POST['GmServicecalls'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['GmServicecalls']))
		{
			$model->attributes=$_POST['GmServicecalls'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GmServicecalls');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gmservicecalls('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionReceivedcalls()
	{
		$model=new Gmservicecalls('search_receivedcall');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];
		
		$this->render('receivedcalls',array(
			'model'=>$model,
		));
	}
	
	public function actionReceivedcalldetails($id)
	{
		$model=$this->loadModel($id);
		 
		$this->render('receivedcalldetails',array(
			'model'=>$model,
		));
	}
	
	
	public function actionServicecallsenttogomobileserver()
	{
	header("Access-Control-Allow-Origin: *");
	$servicecall_recieved=$_POST['servicecall_ids'];
	//$data='{"unsent_servicecalls":[{"service_reference_number":"127550","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"},{"service_reference_number":"127548","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"}],"sent_servicecalls":[{"service_reference_number":"127542","message":"Servicecall Sent"}]} ';
	$mydata=json_decode($servicecall_recieved);
	
	foreach ($mydata->unsent_servicecalls as $servicecalls)
		{	
			$unsent_servicecalls_ref_no=$servicecalls->service_reference_number;
			$comments=$servicecalls->message;
			$this->savesentservicecallstatus($unsent_servicecalls_ref_no, '3',$comments);///since 3 is rejected status
		}
		
	foreach ($mydata->sent_servicecalls as $servicecalls)
		{	
			$sent_servicecalls_ref_no=$servicecalls->service_reference_number;
			$comments=$servicecalls->message;
			$this->savesentservicecallstatus($sent_servicecalls_ref_no, '1', $comments);///since 1 is sent status
		}
	}///// end of Servicecallsenttogomobileserver
	
	
	public function actionServicecallreceivedfromgomobileserver()
	{
	header("Access-Control-Allow-Origin: *");
	$servicecall_recieved=$_POST['data'];
	//$servicecall_recieved='[[{"service_reference_number":127549,"work_carried_out":"{\"report_findings\":\"iphone 6\",\"workdone\":\"WORK DONE\",\"parts\":[{\"partused\":\"bearing\",\"quantity\":\"50\"}]}"}],[{"service_reference_number":127542,"work_carried_out":"{\"report_findings\":\"i found a wet Floor\\t\\t\",\"workdone\":\"This is work Done I replaced Bearings\\t\",\"parts\":[{\"partused\":\"Bearing\",\"quantity\":\"50\"},{\"partused\":\"Seal\",\"quantity\":\"50\"}]}"}],[{"service_reference_number":127542,"work_carried_out":"{\"report_findings\":\"i found a wet Floor\\t\\t\",\"workdone\":\"This is work Done I replaced Bearings\\t\",\"parts\":[{\"partused\":\"Bearing\",\"quantity\":\"50\"},{\"partused\":\"Seal\",\"quantity\":\"50\"}]}"}],[{"service_reference_number":127542,"work_carried_out":"{\"report_findings\":\"i found a wet Floor\\t\\t\",\"workdone\":\"This is work Done I replaced Bearings\\t\",\"parts\":[{\"partused\":\"Bearing\",\"quantity\":\"50\"},{\"partused\":\"Seal\",\"quantity\":\"50\"}]}"}]]';
	$mydata=json_decode($servicecall_recieved);
	//print_r($servicecall_recieved);
	
	
	foreach ($mydata as $servicecalls)
	{
	
			$received_servicecalls_ref_no=$servicecalls[0]->service_reference_number;
			$comments=$servicecalls[0]->work_carried_out;
			$this->savesentservicecallstatus($received_servicecalls_ref_no, '5',$comments);///since 5 is received from mobile status
	}//end of foreach 
	
	}
	
	
	
	public function actionReceiveservicecallfrommobile()
	{
	 $this->render('receiveservicecallfrommobile');
	}
	
	
	public function savesentservicecallstatus($service_ref_no, $received_server_status,$comments)
	{
			$servicecall_id=$this->getserviceidbyservicerefrencenumber($service_ref_no);
			$model=new GmServicecalls;
			$model->servicecall_id=$servicecall_id;
			$model->server_status_id=$received_server_status; 
			$model->service_reference_number=$service_ref_no;
			$model->comments=$comments;
			$model->save();
		
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GmServicecalls the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=GmServicecalls::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GmServicecalls $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gm-servicecalls-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getserviceidbyservicerefrencenumber($service_reference_number)
	{
	
		$sc_model=Servicecall::model()->findByAttributes(array('service_reference_number'=>$service_reference_number));
		return $sc_model->id;
		
	}//end of getserviceidbyservicerefrencenumber
	

}

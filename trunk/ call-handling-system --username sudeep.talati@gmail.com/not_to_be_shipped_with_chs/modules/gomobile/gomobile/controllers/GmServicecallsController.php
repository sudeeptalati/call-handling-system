<?php

class GmServicecallsController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Servicecallsenttogomobileserver'),
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
		$model=new GmServicecalls('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionServicecallsenttogomobileserver()
	{
	header("Access-Control-Allow-Origin: *");
	
	$servicecall_recieved=$_POST['servicecall_ids'];
	print_r($servicecall_recieved);
	$servicecall_recieved_array=json_decode($servicecall_recieved);
		foreach($servicecall_recieved_array as $service_reference_number)
		{	
			$servicecall_id=$this->getserviceidbyservicerefrencenumber($service_reference_number);
			
			$model=new GmServicecalls;
			$model->servicecall_id=$servicecall_id;
			$model->mobile_status_id='1';//since1 is 'sent' status
			$model->service_reference_number=$service_reference_number;
			$model->save();
		
		}////end of foreach
	}///// end of Servicecallsenttogomobileserver

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

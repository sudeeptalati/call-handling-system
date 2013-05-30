<?php

class ContractController extends Controller
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
				'actions'=>array('create','update','view','index','admin'),
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
		$model=new Contract;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contract'],$_POST['ContactDetails']))
		{
			 echo "<br>In controller, create action ";
			 $contactDetailsModel=new ContactDetails;
			 $contactDetailsModel->attributes=$_POST['ContactDetails'];
			 
			 $model->attributes = $_POST['Contract'];
			 
			 $valid=$model->validate();
			 $valid=$contactDetailsModel->validate() && $valid;
			 
			 $labWarrMonths = $_POST['labour_months'];
			 echo "<br>IN Controller Labour Warranty in months, value got from form = ".$labWarrMonths;
			 
			 $labWarrYear = $_POST['labour_years'];
			 echo "<br>IN Controller Labour Warranty in Years, value got from form = ".$labWarrYear;
			 
			 $partsWarrMonths = $_POST['parts_months'];
			 //echo "<hr>IN Controller Parts Warranty in months, value got from form = ".$partsWarrMonths;
			 
			 $partsWarrYear = $_POST['parts_years'];
			 //echo "<br>IN Controller Parts Warranty in Years, value got from form = ".$partsWarrYear;
			 
			 $finalLabourWarranty = $this->convertToSaveTodb($labWarrMonths, $labWarrYear);  
			 $finalPartsWarranty = $this->convertToSaveTodb($partsWarrMonths, $partsWarrYear);
			 
			 $model->labour_warranty_months_duration = $finalLabourWarranty;
			 $model->parts_warranty_months_duration = $finalPartsWarranty;
			 
			 /*
			 if($valid)
        	 {
        	 	if($model->save())
					$this->redirect(array('view','id'=>$model->id));
        	 }
        	 else 
        	 {
        	 	echo "Enter all the mandatory fields";
        	 }
        	 */
		}//END OF IF(ISSET()).
			 
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
		$contactDetailsModel=ContactDetails::model()->findByPk($model->main_contact_details_id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contract'],$_POST['ContactDetails']))
		{
			$model->attributes=$_POST['Contract'];
			$contactDetailsModel->attributes=$_POST['ContactDetails'];
			
			$valid=$model->validate();
        	$valid=$contactDetailsModel->validate() && $valid;
        	
        	if($valid)
        	{
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
        	}
        	else 
        	{
        		echo "Fill all mandatory fields";
        	}
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
			$contractModel=Contract::model()->findByPk($id);
			$contactDetailsModel=ContactDetails::model()->findByPk($contractModel->main_contact_details_id);
			//echo "CONTACT DETAILS ID IN DELETE:".$contractModel->main_contact_details_id;
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			$contactDetailsModel->delete();
			
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
		$dataProvider=new CActiveDataProvider('Contract');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contract('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contract']))
			$model->attributes=$_GET['Contract'];

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
		$model=Contract::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contract-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}//end of performAjaxValidation.
	
	public function convertToSaveTodb($monthValue, $yearValue)
	{
		//echo "<hr>Month Values in FUNC = ".$monthValue;
		//echo "<br>Year Values in FUNC = ".$yearValue;
		$year_to_months = $yearValue * 12;
		//echo "<br>Years converted to months = ".$year_to_months;
		$total_months = $year_to_months + $monthValue;
		//echo "<br>Final value to be saved = ".$total_months;
		return $total_months;
	}
	
	
}//end of class.

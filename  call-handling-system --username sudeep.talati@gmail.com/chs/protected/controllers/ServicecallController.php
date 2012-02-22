<?php

class ServicecallController extends Controller
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
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('admin','delete'),
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
	
	public function actionPreview($id)
	{
		$model=$this->loadModel($id);

		
// 		$this->renderPartial('Preview',array(
// 			'model'=>$this->loadModel($id),
// 		));
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A5');
		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,), true));
		# Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
		$mPDF1->WriteHTML($stylesheet, 1);
		# Outputs ready PDF
		$mPDF1->Output();
		
	}
	
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Servicecall;
		$customerModel=new Customer;
		$model->job_status_id=1;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Servicecall'],$_POST['Customer']))
		{
			$model->attributes=$_POST['Servicecall'];
			
			$customerModel->attributes=$_POST['Customer'];
			
			
			$valid=$model->validate();
			$valid=$customerModel->validate() && $valid;
			
			if($valid)
			{
				if($model->save())
				{
					$engg_id=$model->engineer_id;
				$baseUrl=Yii::app()->request->baseUrl;
				$this->redirect($baseUrl.'/enggdiary/create/'.$model->id.'?engineer_id='.$engg_id);
					
				}
			}
			else 
			{
				echo "Fill all madatory fields";
			}
		}//end of if(isset()).

		$this->render('create',array(
			'model'=>$model,
		));
	}//end of create.

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

		if(isset($_POST['Servicecall']))
		{
			$model->attributes=$_POST['Servicecall'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}//end of if(isset()).

		$this->render('updateServicecall',array(
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
		$dataProvider=new CActiveDataProvider('Servicecall');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Servicecall('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Servicecall']))
			$model->attributes=$_GET['Servicecall'];

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
		$model=Servicecall::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionExistingCustomer($customer_id)
	{
		$model=new Servicecall;
		$model->job_status_id=1;
		//echo "IN ACTION EXISTING CUSTOMER ";
		//echo "CUSTOMER ID IN SERVICE CONTROLLER :".$customer_id;
		
		if(isset($_POST['Servicecall']))
		{
			$model->attributes=$_POST['Servicecall'];
			//echo "NEW  ENGG".$model->engineer_id;
			//echo "CONTRACT ID :".$model->contract_id;
			
			if($model->save())
			{
				$engg_id=$model->engineer_id;
				$baseUrl=Yii::app()->request->baseUrl;
				$this->redirect($baseUrl.'/enggdiary/create/'.$model->id.'?engineer_id='.$engg_id);
			}		
		}//end of if(isset()).
		
		
		$this->render('existingCustomer',array(
			'model'=>$model,
		));
		
	}//end of actionExistingCustomer().
	
//CODE FROM GII FORM GENERATOR.	
	
	public function actionUpdateServicecall()
	{
    	$model=new Servicecall('update');

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-updateServicecall-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	
	    if(isset($_POST['Servicecall']))
	    {
	        $model->attributes=$_POST['Servicecall'];
	        if($model->validate())
	        {
	            // form inputs are valid, do something here
	            return;
	        }
	    }
	    $this->render('updateServicecall',array('model'=>$model));
	}//end of updateServicecall.

		
	
	
}//end of class.

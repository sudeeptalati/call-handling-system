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
				'actions'=>array('create','update','ChangeEngineer'),
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
		//echo "THIS IS SELECTED :".$model->engineer_id;
		
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			
			if($model->save())
			{
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
		}
	    
		if(isset($_POST['Enggdiary']))
    	{
        $model->attributes=$_POST['Enggdiary'];
        //echo "I M INSIDE AND id is ".$model->engineer_id;
        if ($model->servicecall_id)
        	{
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
	
	
}//end of class.

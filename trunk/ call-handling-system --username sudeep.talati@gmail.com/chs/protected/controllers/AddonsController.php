<?php

class AddonsController extends Controller
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
				'actions'=>array('create','update', 'install'),
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
	public function actionIndex()
	{
		 $this->render('index');
	}
	
	
	
 	public function actionInstall()
	{
	//echo "*******************";
		$model=new Addons();
		//Step 1: Download or upload package in temp folder
		$model->upload();
		//Step 2: Unzip it
		$model->unzip();
		//Step 3: Read the XML Install Script
		$addons_model=new Addons();
		$xml=simplexml_load_file("temp/tempaddonfile/install_addon.xml");
		$addons_model->id=$xml->info->id;
		$addons_model->name=$xml->info->name;
		$addons_model->addon_label=$xml->info->label;
		$addons_model->type=$xml->info->name;
		if(!$addons_model->save())
		{
			echo "<br>-----------------module already exist <br>";
			$errors=$addons_model->getErrors();
			foreach ($errors as $e)
			{
				
				echo $e[0]."<br>";
			}
		}
		else
		{
			echo "<hr>new module installed.";

		}
		//Step 4: Install Table
		$model->readscript();
		//Step 5: Copy files images, javascript and all
		$model->copyfiles();
		//Step 6: Create Entry in XML file in Config Folder
		
		/*
		Step 7: Create entry in table
		Step 8: Ammend if you want for javascript like in main file.
		*/
		
		
		$this->redirect(array('admin')); 
		
		//$this->render('install',array(
			//'model'=>$model,
		//));
		
		
	
	}///endo of actionInstall
	
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
		$model=new Addons;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addons']))
		{
			$model->attributes=$_POST['Addons'];
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

		if(isset($_POST['Addons']))
		{
			$model->attributes=$_POST['Addons'];
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


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Addons('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Addons']))
			$model->attributes=$_GET['Addons'];

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
		$model=Addons::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='addons-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionInstalladdon()
	{
		$model=new Setup;
		
		$this->render('Installaddon',array('model'=>$model));
	}
}

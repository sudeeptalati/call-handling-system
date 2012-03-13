<?php

class ConfigController extends Controller
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
				'actions'=>array('restoreDatabase','update','admin','changeLogo','emailSetup','about'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
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
/*DISABLED 
	public function actionCreate()
	{
		$model=new Config;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	*/
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

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
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
	/* DISABLD
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
*/
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Config');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	
	
	public function actionAdmin()
	{
	
		$this->render('admin');
	}

	
	public function actionChangeLogo()
	{
	   
	
	    if(isset($_POST['finish']))
		{
	        if (( ($_FILES["logo_url"]["type"] == "image/png")) && ($_FILES["logo_url"]["size"] < 1000000))
				{
//					echo "YEPPTY";
					if ($_FILES["logo_url"]["error"] > 0)
						{
							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
							}
					else
					{
//						echo "Upload: " . $_FILES["logo_url"]["name"] . "<br />";				
//						echo "Type: " . $_FILES["logo_url"]["type"] . "<br />";
//						echo "Size: " . ($_FILES["logo_url"]["size"] / 1024) . " Kb<br />";
//						echo "Temp uploaded: " . $_FILES["logo_url"]["tmp_name"] . "<br />";
//						$uploadedname="company_logo.png";
						
						$uploaded_file= $_FILES["logo_url"]["tmp_name"];
						$location="images/company_logo.png";
						//echo '<br>'.$location;
							if (move_uploaded_file($uploaded_file,$location))
							{
								echo "Stored";
							}
							else
								{
									echo "Not Stored: ";
								}
								
								
					}//end of else

				}///end of file upload if
				else
				{
				echo "Invalid FILE";
				}//end of else
	        

	    	}//end of isset post finish
	    $this->render('changeLogo');
	}///end of function chgange logo
	
	public function actionEmailSetup()
	{
	
		$this->render('admin');
	}

	public function actionAbout()
	{
	
		$this->render('about');
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Config::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionRestoreDatabase()
	{
	   
	    if(isset($_POST['finish']))
		{
//			echo 'DATA BASEFILE :  '. $_FILES["database"]["error"];
			
	        if ($_FILES["database"]["type"] == "application/octet-stream" && $_FILES["database"]["name"] == "chs.db")
				{
					if ($_FILES["database"]["error"] > 0)
						{
							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
						}//end of if for error
					else
					{
						echo 'YEPPY';
						
						$uploaded_file= $_FILES["database"]["tmp_name"];
						$location="protected/data/chs.db";
						//echo '<br>'.$location;
							if (move_uploaded_file($uploaded_file,$location))
							{
								echo "<span style='background-color:green; color:black;' > Database Restored </span><br>";
							}
							else
								{
									echo '<span style="background-color:red; color:black;">Not Stored , Please try again</span><br> ';		
								}
						
					}//end of else
				}///end of if for check for database file check
				else {
					echo '<span style="background-color:red; color:black;">Please upload chs.db file only</span><br> ';		
				}
				
				
			
		}//ennd of if of post finish
		
		$this->render('restoreDatabase');
		
//	        if (( ($_FILES["database"]["type"] == "application/octet-stream")) && ($_FILES["logo_url"]["size"] < 1000000))
//				{
////					echo "YEPPTY";
//					if ($_FILES["logo_url"]["error"] > 0)
//						{
//							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
//							}
//					else
//					{
////						echo "Upload: " . $_FILES["logo_url"]["name"] . "<br />";				
////						echo "Type: " . $_FILES["logo_url"]["type"] . "<br />";
////						echo "Size: " . ($_FILES["logo_url"]["size"] / 1024) . " Kb<br />";
////						echo "Temp uploaded: " . $_FILES["logo_url"]["tmp_name"] . "<br />";
////						$uploadedname="company_logo.png";
//						
//						$uploaded_file= $_FILES["logo_url"]["tmp_name"];
//						$location="images/company_logo.png";
//						//echo '<br>'.$location;
//							if (move_uploaded_file($uploaded_file,$location))
//							{
//								echo "Stored";
//							}
//							else
//								{
//									echo "Not Stored: ";
//								}
//								
//								
//					}//end of else
//
//				}///end of file upload if
//				else
//				{
//				echo "Invalid FILE";
//				}//end of else
//	        
//
//	    	}//end of isset post finish
	    
	}///end of function Restore Database
}
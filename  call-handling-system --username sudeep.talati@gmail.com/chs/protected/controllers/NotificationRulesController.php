<?php



///*THISI SSUS A  TEST COMMENT***/////



class NotificationRulesController extends Controller
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
				'actions'=>array('create','update','admin','delete','ViewRules','NotificationPresent'),
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
		$this->render('viewRules',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NotificationRules;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['NotificationRules']))
		{
			$model->attributes=$_POST['NotificationRules'];
			$model->active = '1';
			echo "job status id from create form = ".$model->job_status_id."<br>";
			
			/************** MANIPULATION OF NOTIFY OTHERS CODE ****************/
				
			if(isset($_POST['others_person_details']))
			{
				$model->notify_others = 1;
			}
			else
			{
				$model->notify_others = 0;
			}
				
			/************** END OF MANIPULATION OF NOTIFY OTHERS CODE ****************/
			
			
			
			/***** MANIPULATION OF CUSTOMER NOTIFICATION CODE ***********/
			
//			echo "CUST NOTIFICATION CHECKBOX from create form = ".$model->customer_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['customer_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['customer_sms_notification']."<hr>";
			
			$customer_email_checked=$_POST['customer_email_notification'];
			$customer_sms_checked=$_POST['customer_sms_notification'];
			
			$customer_email_status;
			$customer_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($customer_email_checked==1)
				$customer_email_status=true;
			else 
				$customer_email_status=false;
			
				
			if ($customer_sms_checked==1)
				$customer_sms_status=true;
			else 
				$customer_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$customer_notification_code=$model->getNotificationCode($customer_email_status, $customer_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->customer_notification_code = $customer_notification_code;
			
			/***** END OF MANIPULATION OF CUSTOMER NOTIFICATION CODE ***********/
			
			/***** MANIPULATION OF ENGINEER NOTIFICATION CODE *******/
//			echo "ENGINEER NOTIFICATION CHECKBOX from create form = ".$model->engineer_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['engineer_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['engineer_sms_notification']."<hr>";
			
			$engineer_email_checked=$_POST['engineer_email_notification'];
			$engineer_sms_checked=$_POST['engineer_sms_notification'];
			
			$engineer_email_status;
			$engineer_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($engineer_email_checked==1)
				$engineer_email_status=true;
			else 
				$engineer_email_status=false;
			
				
			if ($engineer_sms_checked==1)
				$engineer_sms_status=true;
			else 
				$engineer_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$engineer_notification_code=$model->getNotificationCode($engineer_email_status, $engineer_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->engineer_notification_code = $engineer_notification_code;
			
			/***** END OF MANIPULATION OF ENGINEER NOTIFICATION CODE *******/
			
			/******** MANIPULATION OF WARRANTY PROVIDER NOTIFICATION CODE ************/
//			echo "WARRANTY PROVIDER NOTIFICATION CHECKBOX from create form = ".$model->warranty_provider_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['warranty_provider_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['warranty_provider_sms_notification']."<hr>";
			
			$warranty_provider_email_checked=$_POST['warranty_provider_email_notification'];
			$warranty_provider_sms_checked=$_POST['warranty_provider_sms_notification'];
			
			$warranty_provider_email_status;
			$warranty_provider_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($warranty_provider_email_checked==1)
				$warranty_provider_email_status=true;
			else 
				$warranty_provider_email_status=false;
			
				
			if ($warranty_provider_sms_checked==1)
				$warranty_provider_sms_status=true;
			else 
				$warranty_provider_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$warranty_provider_notification_code=$model->getNotificationCode($warranty_provider_email_status, $warranty_provider_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->warranty_provider_notification_code = $warranty_provider_notification_code;
			
			/******** END OF MANIPULATION OF WARRANTY PROVIDER NOTIFICATION CODE ************/
			
			
			
			if($model->save())
			{
				//if($model->notify_others == '1')
// 				if(isset($_POST['others_person_details']))
// 				{
// 					$this->redirect(array('update','id'=>$model->id, 'showDialogue'=>'1'));
// 					return ;
// 				}//end of redirecting to update
// 				else 
// 				{
// 					$this->redirect(array('view','id'=>$model->id));	
// 					return ;
// 				}//end of redirect to view.
			}//end of outer if(save()).
			
			else 
			{
				/**** DIALOGUE BOX TO DISPLAY ERROR CODE ***/
				$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
						'id'=>'formdialog',
						// additional javascript options for the dialog plugin
						'options'=>array(
								'title'=>'Error',
								'autoOpen'=>true,
								'modal'=>'true',
								'show' => 'blind',
								'hide' => 'explode',
						),
				));
				
				echo "Problem in saving, there may already be a rule for this status";
										
				$this->endWidget('zii.widgets.jui.CJuiDialog'); 
				
				/**** END OF DIALOGUE BOX TO DISPLAY ERROR CODE ***/
			}//END OF ELSE OF SAVE().
				
		}//end of if(issset()).

		$this->render('create',array(
			'model'=>$model,
		));
	}//end of create().

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

		if(isset($_POST['NotificationRules']))
		{
			$model->attributes=$_POST['NotificationRules'];
			
			/***** MANIPULATION OF CUSTOMER NOTIFICATION CODE ***********/
			
//			echo "CUST NOTIFICATION CHECKBOX from create form = ".$model->customer_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['customer_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['customer_sms_notification']."<hr>";
			
			$customer_email_checked=$_POST['customer_email_notification'];
			$customer_sms_checked=$_POST['customer_sms_notification'];
			
			$customer_email_status;
			$customer_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($customer_email_checked==1)
				$customer_email_status=true;
			else 
				$customer_email_status=false;
			
				
			if ($customer_sms_checked==1)
				$customer_sms_status=true;
			else 
				$customer_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$customer_notification_code=$model->getNotificationCode($customer_email_status, $customer_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->customer_notification_code = $customer_notification_code;
			
			/***** END OF MANIPULATION OF CUSTOMER NOTIFICATION CODE ***********/
			
			/***** MANIPULATION OF ENGINEER NOTIFICATION CODE *******/
//			echo "ENGINEER NOTIFICATION CHECKBOX from create form = ".$model->engineer_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['engineer_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['engineer_sms_notification']."<hr>";
			
			$engineer_email_checked=$_POST['engineer_email_notification'];
			$engineer_sms_checked=$_POST['engineer_sms_notification'];
			
			$engineer_email_status;
			$engineer_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($engineer_email_checked==1)
				$engineer_email_status=true;
			else 
				$engineer_email_status=false;
			
				
			if ($engineer_sms_checked==1)
				$engineer_sms_status=true;
			else 
				$engineer_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$engineer_notification_code=$model->getNotificationCode($engineer_email_status, $engineer_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->engineer_notification_code = $engineer_notification_code;
			
			/***** END OF MANIPULATION OF ENGINEER NOTIFICATION CODE *******/
			
			/******** MANIPULATION OF WARRANTY PROVIDER NOTIFICATION CODE ************/
//			echo "WARRANTY PROVIDER NOTIFICATION CHECKBOX from create form = ".$model->warranty_provider_notification_code."<br>";
//			echo "EMAIL CHECKBOX from create form = ".$_POST['warranty_provider_email_notification']."<br>";
//			echo "SMS CHECKBOX from create form = ".$_POST['warranty_provider_sms_notification']."<hr>";
			
			$warranty_provider_email_checked=$_POST['warranty_provider_email_notification'];
			$warranty_provider_sms_checked=$_POST['warranty_provider_sms_notification'];
			
			$warranty_provider_email_status;
			$warranty_provider_sms_status;

			//*Setting the email & sms status from the value obtained*//
			if ($warranty_provider_email_checked==1)
				$warranty_provider_email_status=true;
			else 
				$warranty_provider_email_status=false;
			
				
			if ($warranty_provider_sms_checked==1)
				$warranty_provider_sms_status=true;
			else 
				$warranty_provider_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$warranty_provider_notification_code=$model->getNotificationCode($warranty_provider_email_status, $warranty_provider_sms_status);
			
			//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
			$model->warranty_provider_notification_code = $warranty_provider_notification_code;
			
			/******** END OF MANIPULATION OF WARRANTY PROVIDER NOTIFICATION CODE ************/
			
			/************** MANIPULATION OF NOTIFY OTHERS CODE ****************/
			
			if($model->notify_others == 0)
			{
				if(isset($_POST['others_person_details']))
				{
					$model->notify_others = 1;
					if($model->save())
					{
						$this->redirect(array('update','id'=>$model->id, 'showDialogue'=>'1'));
					}
				}//end of if(isset()).
				else 
				{
					$model->notify_others = 0;
					
				}
			}//end of if.
			
			/************** END OF MANIPULATION OF NOTIFY OTHERS CODE ****************/
			
			
			if($model->save())
			{
				$this->redirect(array('viewRules','id'=>$model->id));
				
			}//end of if (save())
		}//end of if(isset()).

		$this->render('update',array('model'=>$model, 'showDialogue'=>'1'));
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
		$dataProvider=new CActiveDataProvider('NotificationRules');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NotificationRules('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NotificationRules']))
			$model->attributes=$_GET['NotificationRules'];

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
		$model=NotificationRules::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='notification-rules-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}//end of AJAX.
	
	
	public function actionViewRules($id)
	{
		//$model=new NotificationRules('view');
		$model=$this->loadModel($id);
	
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='notification-rules-viewRules-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['NotificationRules']))
		{
			$model->attributes=$_POST['NotificationRules'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('viewRules',array('model'=>$model));
	}//end of viewRules().
	
	public function actionNotificationPresent()
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			//pick off the parameter value
			$job_id = Yii::app()->request->getParam( 'job_id' );
			if($job_id != '')
			{
				//echo "Id is received is ".$job_id;
				
				$rulesModel = NotificationRules::model()->findAllByAttributes(array('job_status_id'=>$job_id));
// 				foreach ($rulesModel as $data)
// 				{
// 					echo $data->id;
// 				}
				
				
				if(count($rulesModel))
					echo 1;
				else 
					echo 0;
				
			}//end of if(job_id)
			else
			{
				//echo "Id id not received";
				echo 0;
				
			}
		
		}//end of if(AjaxRequest).
		
		
		
		
	}//end of NotificationPresent().
	
}//end of class.

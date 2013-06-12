<?php

class EngineerController extends Controller
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
				'actions'=>array('create','update', 'admin'),
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
		$model=new Engineer();
		$contactDetailsModel=new ContactDetails();
		$deliveryDetailsModel=new ContactDetails();
		

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model, $contactDetailsModel, $deliveryDetailsModel);
		
		
		if(isset($_POST['Engineer'],$_POST['ContactDetails']))
		{
			$model->attributes=$_POST['Engineer'];
			
			
			$contactDetailsModel->attributes=$_POST['ContactDetails'][1];
			
			
			$deliveryDetailsModel->attributes=$_POST['ContactDetails'][2];
			
			$engg_valid=$model->validate();
			$contact_details_valid=$contactDetailsModel->validate();
			//$valid=$deliveryDetailsModel->validate() && $valid;
			
			if($engg_valid && $contact_details_valid)
        	{
        		
        		//******* ContactDetails MODEL TO SAVE CONTACT DETAILS.
        		 	
        		//echo"<br>Address 1 of engg contact details = ".$contactDetailsModel->address_line_1;
        		$contactDetailsModel->save();
        		//echo "<br>id if contact details = ".$contactDetailsModel->id;
        		$model->contact_details_id = $contactDetailsModel->id;
        			
        		//******  MAENS DELIVERY ADDRESS IS SAME AS CONTACT ADDRESS *********
        		if(isset($_POST['delivery_checkbox']))
        		{
        			echo "<br>Delivery contact details checkbox status = ".$_POST['delivery_checkbox'];
        			$model->delivery_contact_details_id = $contactDetailsModel->id;
        			
        		}//end if if()isset(checkbox) i.e, checkbox is checked.
        		else //******* MEANS DELIVERY ADDRESS IS DIFFERENT THAN CONTACT ADDRESS  *********
        		{
        			echo "<br>Checbox is checked";
        			
        			echo "<br>Address 1 of delivery contact details = ".$deliveryDetailsModel->address_line_1;
        			$deliveryDetailsModel->lockcode = 0;
        			if($deliveryDetailsModel->save())
        			{
        				echo "<br>Delivery contact details id = ".$deliveryDetailsModel->id;
        				$model->delivery_contact_details_id = $deliveryDetailsModel->id;
        			}
        			else
        				echo "<br>NOT SAVED DELIVRY MODEL";
        		}//end of else i.e, checkbox is not checked.
        		
				if($model->save())
				{
					$this->redirect(array('view','id'=>$model->id));
				}
				
        	}//end if if(valid).
        	else 
        	{
        		echo "<hr>Enter all the mandatory fields of address also";
        		
        	}//end of else.
		}//end of if(issset()).

		$this->render('create',array(
			'model'=>$model,'contactDetailsModel'=>$contactDetailsModel,'deliveryDetailsModel'=>$deliveryDetailsModel
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
		
		$contactDetailsModel=ContactDetails::model()->findByPk($model->contact_details_id);
		
		$deliveryDetailsModel=ContactDetails::model()->findByPk($model->delivery_contact_details_id);
		
		$create_new_contact = '';
		$delivery_checkbox = '';
		
		$earlier_active = $model->active;
		//echo "<br>Actuve value before = ".$earlier_active;
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Engineer'],$_POST['ContactDetails']))
		{
			$model->attributes=$_POST['Engineer'];
			
			$contactDetailsModel->attributes=$_POST['ContactDetails'][1];// GETTING CONTACT DETAILS
			
			$deliveryDetailsModel->attributes=$_POST['ContactDetails'][2];// GETTING CONTACT DETAILS FROM BELOW FORM.
			
			$valid=$model->validate();
			$valid=$contactDetailsModel->validate() && $valid;
			
			if($model->delivery_contact_details_id != $model->contact_details_id)
				$valid=$deliveryDetailsModel->validate() && $valid;
			
			if($valid)
			{
				$contactDetailsModel->save();
				$model->contact_details_id = $contactDetailsModel->id;
				
				//******** CHECKING same as above CHECKBOX STATUS ***********
				if(isset($_POST['delivery_checkbox']))
				{
					//echo "<br>checkbox is checked, i.e, SAME contact id";
					$delivery_checkbox = 1;
				}
				else
				{
					//echo "<br>Ccheckbox is not checked, DIFFERENT contact id";
					$delivery_checkbox = 0;
				}
				//******** END OF CHECKING same as above CHECKBOX STATUS ***********
				
				//********** COMPARING IF ALL FIELDS ARE SAME OR NOT OF BOTH contact_details MODELS *******
				$model_arr1 = $contactDetailsModel->attributes;
				$model_arr2 = $deliveryDetailsModel->attributes;
				
				foreach($model_arr1 as $key => $value)
				{
					if($model_arr1[$key] != $model_arr2[$key])
					{
						//do something
						//echo "<br>".$model_arr2[$key]." this field is differnt, create new contact_details";
						$create_new_contact = 1;
					}
				}//end of foreach.
				//********** END OF COMPARING IF ALL FIELDS ARE SAME OR NOT OF BOTH contact_details MODELS *******
				
				//CREAT NEW contact_details MODEL IF CHECKBOX IS NOT CHECKED AND IF THERE IS ANY CHANGE IN BOTH contact_details MODELS 
				if($create_new_contact == 1 && $delivery_checkbox == 0)
				{
					//echo "<br>Create new contact details model";
					$newDeliveryContactModel = new ContactDetails();
					$newDeliveryContactModel->attributes=$_POST['ContactDetails'][2];
					$newDeliveryContactModel->save();
					//echo "<br>New delivery model id = ".$newDeliveryContactModel->id;
					$model->delivery_contact_details_id = $newDeliveryContactModel->id;
					
				}//end of if create_new_contact.
				else 
				{
					//echo "<br>Everything same";
					$model->delivery_contact_details_id = $model->contact_details_id;
				}
				//CREAT NEW contact_details MODEL IF CHECKBOX IS NOT CHECKED AND IF THERE IS ANY CHANGE IN BOTH contact_details MODELS
				
				echo "<br>Delivery contact details id = ".$model->delivery_contact_details_id;
				
				//******* CHECK IF ACTIVE IS CHANGED. I.E, IF ENGINEER IS DEACTIVATED.
				echo "<br>Active value now = ".$model->active;
				
				if($earlier_active == 1)
				{
					if($model->active == 0)
					{
						$model->inactivated_on = time();
						$model->inactivated_by_user_id = Yii::app()->user->id;
					}//end of inner if().
					
				}//end of if($$earlier_active)
				
				
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
				
			}//end of if(valid).
			else 
			{
				echo "Fill all mandatory fields";
			}
		}//end of if(isset()).

		$this->render('update',array(
			'model'=>$model,'contactDetailsModel'=>$contactDetailsModel, 'deliveryDetailsModel'=>$deliveryDetailsModel,
		));
	}//end of update().

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			
			$engineerModel=Engineer::model()->findByPk($id);
			$contactDetailsModel=ContactDetails::model()->findByPk($engineerModel->contact_details_id);
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			$contactDetailsModel->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}//end of delete().

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Engineer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Engineer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Engineer']))
			$model->attributes=$_GET['Engineer'];

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
		$model=Engineer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model, $contactDetailsModel,$deliveryDetailsModel )
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='engineer-form')
		{
			echo CActiveForm::validate(array($model, $contactDetailsModel,$deliveryDetailsModel));
			Yii::app()->end();
		}
	}//end of performAjaxValidation().
	
}//end of class.

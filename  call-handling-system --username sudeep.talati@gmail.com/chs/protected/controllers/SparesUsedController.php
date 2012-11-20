<?php

class SparesUsedController extends Controller
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
				'actions'=>array('GenerateSparesOrderFormPdf','delete','create','admin','update','TempJson' ,'NewItemDetails','SaveData','MasterFreeSearch','MasterSearchData','OpenDialogueBox'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('GetPdf','admin','delete'),
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
		$model=new SparesUsed;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SparesUsed']))
		{
			$model->attributes=$_POST['SparesUsed'];
			if($model->save())
			{
			     if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Classroom successfully added"
                        ));
                    exit;               
                }//end of if ajax request.
                else
                {
					$this->redirect(array('view','id'=>$model->id));
                }
			}//end of if save.
		}//end if if isset.
		
	    if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
            exit;               
        }
        else
        {
			$this->render('create',array(
				'model'=>$model,
			));
        }
	}//end of create.
	
	/* ORIGINAL ACTION CREATE....... WORKING FINE........
	
	public function actionCreate()
	{
		$model=new SparesUsed;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SparesUsed']))
		{
			$model->attributes=$_POST['SparesUsed'];
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

		if(isset($_POST['SparesUsed']))
		{
			$model->attributes=$_POST['SparesUsed'];
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
		$service_id = $_GET['servicecall_id'];
		
		$this->redirect(array('/servicecall/update/'.$service_id));
		
		
		/*
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
		*/
	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SparesUsed');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SparesUsed('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SparesUsed']))
			$model->attributes=$_GET['SparesUsed'];

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
		$model=SparesUsed::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='spares-used-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/****** UER DEFINED ACTIONS ********/
	
	public function actionMasterFreeSearch($service_id)
	{
		$model=new SparesUsed('search');
		$model->unsetAttributes();
		
		//echo $service_id;

		$this->render('masterFreeSearch',array(
			'service_id'=>$service_id,'model'=>$model,
		));
		
	}// end of actionMasterFreeSearch().
	
	public function actionMasterSearchData($keyword)
	{
		//echo "IN SEARCH DATA";
		
		$service_id=$_GET['service_id'];
		
		$model=new SparesUsed('search');
		$model->unsetAttributes();  // clear any default values
		
		
		$this->renderPartial('masterSearchData',array(
	      //$this->render('masterSearchData',array(
	               'service_id'=>$service_id, 'keyword'=>$keyword,'model'=>$model,
	        ));
	}//end of actionMasterSearchData().
	
	public function actionSaveData()
	{
		//echo "in savedata action<hr>";
		$qty = $_POST['quantity'];
		$name = $_POST['name'];
		$part_number = $_POST['part_number'];
		$master_id = $_POST['master_id'];
		$service_id = $_POST['service_id'];
		$unit_price=$_POST['unit_price'];
//		echo $name."<hr>";
//		echo $part_number."<hr>";
//		echo $master_id."<hr>";
//		echo $service_id."<hr>";
//		echo $qty;
		
		$model= new SparesUsed;
		$model->master_item_id=$master_id;
		$model->servicecall_id=$service_id;
		$model->item_name=$name;
		$model->part_number=$part_number;
		$model->quantity=$qty;
		$model->unit_price=$unit_price;
		
		if($model->save())
		{
			//echo "SAVED";
			$serviceModel = Servicecall::model()->findByPk($service_id);
			$serviceUpdateModel = Servicecall::model()->updateByPk(
																	$serviceModel->id,
																	array
																	(
																		'spares_used_status_id'=>1
																	)
																	);
																	
			/************ CODE TO ADD DATA TO JSON FILE **********/
																	
				//echo $model->item_name."<hr>".$model->servicecall_id."<hr>";
				//echo $model->servicecall->product->productType->name."<hr>";
				$productType_id = $model->servicecall->product->productType->id;
				$productType = $model->servicecall->product->productType->name;
				//echo $model->servicecall->product->brand->name;
				$brandId = $model->servicecall->product->brand->id;
				$brandName = $model->servicecall->product->brand->name;
				$model_number = $model->servicecall->product->model_number; 
				$serial_number = $model->servicecall->product->serial_number;
				//$barcode = $model->servicecall->product->barcode;
				$enr_number = $model->servicecall->product->enr_number;
				$fnr_number = $model->servicecall->product->fnr_number;
				$productionCode = $model->servicecall->product->production_code;
				//$original_modelNumber = strtoupper($model_number);
				$modelVar = preg_replace("/[^A-Za-z0-9]/", "", $model_number);
				$modelTrimmed = trim($modelVar);
				$original_modelNumber = strtoupper($modelTrimmed);
				//$original_partNumber = strtoupper($model->part_number);
				$partVar = preg_replace("/[^A-Za-z0-9]/", "", $model->part_number);
				$partTrimmed = trim($partVar);
				$original_partNumber = strtoupper($partTrimmed);
				//echo strtoupper($serial_number);
				//$var = preg_replace("/[^A-Za-z0-9]/", "", $var);
				
				$paramArray = array();
				$paramArray['brand_id'] = $brandId;
				$paramArray['brand_name'] = $brandName;
				$paramArray['productType_id'] = $productType_id;
				$paramArray['productType'] = $productType;
				$paramArray['model_number'] = $model_number;
				$paramArray['original_model_number'] = $original_modelNumber;
				$paramArray['serial_number'] = $serial_number;
				//$paramArray['barcode'] = $barcode;
				$paramArray['enr_number'] = $enr_number;
				$paramArray['fnr_number'] = $fnr_number;
				$paramArray['production_code']= $productionCode;
				$paramArray['item_name'] = $model->item_name;
				$paramArray['part_number'] = $model->part_number;
				$paramArray['original_partNumber'] = $original_partNumber;
				$paramArray['master_item_id'] = (int)$model->master_item_id;
				
				$sparesModel = SparesUsed::model()->addData($paramArray);
				
				
			/************ END OF CODE TO ADD DATA TO JSON FILE **********/
																																					
		
			$this->redirect(array('servicecall/update/'.$service_id));
			
		}
		else 
		{
			echo "NOT SAVED";
			//print_r($model->getErrors());	
		}
		
	}//end of saveData.
	
	public function actionNewItemDetails()
	{
		//echo "in action newitemdetails<hr>";
		$item_name = $_POST['item_name'];
		$part_number = $_POST['part_number'];
		$unit_price = $_POST['unit_price'];
		$quantity = $_POST['quantity'];
		$master_id = $_POST['master_id'];
		$service_id = $_POST['service_id'];
//		echo $item_name."<hr>";
//		echo $part_number."<hr>";
//		echo $unit_price."<hr>";
//		echo $quantity."<hr>";
//		echo $master_id."<hr>";
//		echo $service_id."<hr>";
		
		$model= new SparesUsed();
		$model->master_item_id=$master_id;
		$model->servicecall_id=$service_id;
		$model->item_name=$item_name;
		$model->part_number=$part_number;
		$model->quantity=$quantity;
		$model->unit_price=$unit_price;
		
		
		if($model->save())
		{
			//echo "SAVED";
			$serviceModel = Servicecall::model()->findByPk($service_id);
			$serviceUpdateModel = Servicecall::model()->updateByPk(
																	$serviceModel->id,
																	array
																	(
																		'spares_used_status_id'=>1
																	)
																	);

		/****************** CODE TO ADD DATA TO JSON FILE ***************/
																	
				//echo $model->item_name."<hr>".$model->servicecall_id."<hr>";
				//echo $model->servicecall->product->productType->name."<hr>";
				$productType_id = $model->servicecall->product->productType->id;
				$productType = $model->servicecall->product->productType->name;
				//echo $model->servicecall->product->brand->name;
				$brandId = $model->servicecall->product->brand->id;
				$brandName = $model->servicecall->product->brand->name;
				$model_number = $model->servicecall->product->model_number; 
				$serial_number = $model->servicecall->product->serial_number;
				//$barcode = $model->servicecall->product->barcode;
				$enr_number = $model->servicecall->product->enr_number;
				$fnr_number = $model->servicecall->product->fnr_number;
				$productionCode = $model->servicecall->product->production_code;
//				$original_modelNumber = strtoupper($model_number);
//				$original_partNumber = strtoupper($model->part_number);
				$modelVar = preg_replace("/[^A-Za-z0-9]/", "", $model_number);
				$modelTrimmed = trim($modelVar);
				$original_modelNumber = strtoupper($modelTrimmed);
				//$original_partNumber = strtoupper($model->part_number);
				$partVar = preg_replace("/[^A-Za-z0-9]/", "", $model->part_number);
				$partTrimmed = trim($partVar);
				$original_partNumber = strtoupper($partTrimmed);
				//echo strtoupper($serial_number);
				
				$paramArray = array();
				$paramArray['brand_id'] = $brandId;
				$paramArray['brand_name'] = $brandName;
				$paramArray['productType_id'] = $productType_id;
				$paramArray['productType'] = $productType;
				$paramArray['model_number'] = $model_number;
				$paramArray['original_model_number'] = $original_modelNumber;
				$paramArray['serial_number'] = $serial_number;
				//$paramArray['barcode'] = $barcode;
				$paramArray['enr_number'] = $enr_number;
				$paramArray['fnr_number'] = $fnr_number;
				$paramArray['production_code']= $productionCode;
				$paramArray['item_name'] = $model->item_name;
				$paramArray['part_number'] = $model->part_number;
				$paramArray['original_partNumber'] = $original_partNumber;
				$paramArray['master_item_id'] = (int)$model->master_item_id;
				
				$sparesModel = SparesUsed::model()->addData($paramArray);
				
				
		/******************** END OF CODE TO ADD DATA TO JSON FILE ****************/																
																	
				
		/********* CODE TO ADD ITEM TO MASTER DATABASE **********/																	
			$created = time();																	
			$db = new PDO('sqlite:../local_items_database/api/master_database.db');
			
			$result = $db->query("INSERT INTO master_items (part_number,name,created) values('$part_number','$item_name','$created')");
		/********* END OF CODE TO ADD ITEM TO MASTER DATABASE **********/
			
			//$this->redirect(array('view','id'=>$model->id));
			$this->redirect(array('servicecall/update/'.$service_id));
		}
		else 
		{
			echo "NOT SAVED";
			//print_r($model->getErrors());	
		}
		
	}//end id newItemSave.
	
	public function actionGenerateSparesOrderFormPdf()
	{
		$service_id=$_GET['service_id'];
	
		$servicecallModel = Servicecall::model()->findByPk($service_id);
		$reference_id=$servicecallModel->service_reference_number;
		
		$setupModel = Setup::model()->findByPk(1);
		$address = $setupModel->address;
		$postcode = $setupModel->postcode;
		$phone = $setupModel->telephone;
		$fax = $setupModel->fax;
		$email = $setupModel->email;
		 
		  
		/*
		 $footer='   <hr style="color:maroon;size:2;width:800px;margin:-5px; " /><p style="clear: both;	font-family: Arial, Helvetica, sans-serif;	font-size:	11px;">  
Please report error or damaage within three days of delivery
to <strong>ISE Limited</strong>, Unit 5/6, Bonnyton Industrial Estate,&nbsp;Kilmarnock,&nbsp;KA1 2NP&nbsp;&nbsp; 
|
Phone Number(Direct Dial): 01563-557152|&nbsp;&nbsp;&nbsp;&nbsp;|FAX: 0845 250 8698|&nbsp;&nbsp;&nbsp;&nbsp;|email: service@iseappliances.co.uk|
</p>';
*/
		
		$footer='   <hr style="color:maroon;size:2;width:800px;margin:-5px; " /><p style="clear: both;	font-family: Arial, Helvetica, sans-serif;	font-size:	11px;">  
Please report error or damaage within three days of delivery
to <strong>ISE Limited</strong>, '.$address.'&nbsp;,&nbsp;'.$postcode.'&nbsp;&nbsp; 
|Phone Number(Direct Dial):  '.$phone.'|&nbsp;&nbsp;&nbsp;&nbsp;|FAX: '.$fax.'|&nbsp;&nbsp;&nbsp;&nbsp;|email: '.$email.'|
</p>';
		 
		$filename=$reference_id.' '.$servicecallModel->engineer->company.'.pdf';

		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		$mPDF1->SetHTMLFooter($footer);
		$mPDF1->WriteHTML($this->renderPartial('sparesform',array('service_id'=>$service_id), true));
 		$mPDF1->Output($filename,'I');
		//$this->renderPartial('sparesform',array('service_id'=>$service_id));
	
	}//end of actionGeneratePdf().
	
	
	public function actionGetPdf()
	{
	
		$service_id=3764;
		$servicecallModel = Servicecall::model()->findByPk($service_id);
		$reference_id=$servicecallModel->service_reference_number;
		  
		 $footer='   <hr style="color:maroon;size:2;width:800px;margin:-5px; " /><p style="clear: both;	font-family: Arial, Helvetica, sans-serif;	font-size:	11px;">  
Please report error or damaage within three days of delivery
to <strong>ISE Limited</strong>, Unit 5/6, Bonnyton Industrial Estate,&nbsp;Kilmarnock,&nbsp;KA1 2NP&nbsp;&nbsp; 
|
Phone Number(Direct Dial): 01563-557152|&nbsp;&nbsp;&nbsp;&nbsp;|FAX: 0845 250 8698|&nbsp;&nbsp;&nbsp;&nbsp;|email: service@iseappliances.co.uk|
</p>';
		  
		$filename=$reference_id.' '.$servicecallModel->engineer->company.'.pdf';

		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		$mPDF1->SetHTMLFooter($footer);
		$mPDF1->WriteHTML($this->renderPartial('sparesform',array('service_id'=>$service_id), true));
 		$mPDF1->Output($filename,'I');
		//$this->renderPartial('sparesform',array('service_id'=>$service_id));
	}
	
}//END OF CLASS.

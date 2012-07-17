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
				'actions'=>array('create','admin','update','TempJson' ,'NewItemDetails','SaveData','MasterFreeSearch','MasterSearchData','OpenDialogueBox'),
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
			$db = new PDO('sqlite:../master_database/api/master_database.db');
			
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
	
	/* *********** TEMP ACTION FOR JSON TEST MUST DELETE LATER ***********************
	public function actionTempJson()
	{
		echo "in action TempJson<hr>";
		$brand_id1=1;
		$product_id1="dish washer";
		$model_num1=1;
		
		$brand_id2=2;
		$product_id2=2;
		$model_num2=2;
		
		$brand_id3=3;
		$product_id3=3;
		$model_num3=3;
		
		//$jsonArr = array('results'=>null);
		$jsonArr = array();

		$temp = array('brand_id'=>$brand_id1, 'product_id'=>$product_id1, 'model_num'=>$model_num1);
//		$temp['brand_id']=$brand_id1;
//		$temp['product_id']=$product_id1;
//		$temp['model_num']=$model_num1;
		
		$temp2 = array();
		$temp2['brand_id']=$brand_id2;
		$temp2['product_id']=$product_id2;
		$temp2['model_num']=$model_num2;
		
//		$jsonArr['results']= $temp;
		array_push($jsonArr, $temp);		

		//echo json_encode(array('result'=>$temp), JSON_FORCE_OBJECT);
		echo json_encode($temp);

//		echo "<hr>".Yii::app()->baseUrl;
//		echo "<hr>".dirname(__FILE__);
		
				
		$filename = '../test.php';
		$fp = fopen($filename, 'r');
		$sData = fread($fp, filesize($filename));
		echo "<hr>".$sData;
		fclose($fp);
		  
		$fp1 = fopen($filename, 'a');
		fwrite($fp1, json_encode($temp));
		fwrite($fp1, json_encode($temp2));
		fclose($fp1);
}//end of actionTempJson.
	
	******************* END OF TEMP ACTION FOR JSON TEST MUST DELETE LATER **********************/
	
	
}//END OF CLASS.
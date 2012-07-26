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
				'actions'=>array('index','view', 'Getitems','curl_file_get_contents'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('addProduct','freeSearch','SearchEngine','PrintAllJobsForDay','UpdateServicecall','ExistingCustomer','Report','preview','create','update','admin'),
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
		$config= Config::model()->findByPk(1);	
    

		//echo 'I M HERE';		
// 		$this->renderPartial('Preview',array(
// 			'model'=>$this->loadModel($id),'config'=>$config,
// 		));
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,'config'=>$config), true));
		# Load a stylesheet
		//$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
		//$mPDF1->WriteHTML($stylesheet, 1);
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
				}//end of $model->save().
			}//end of if(valid).
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

		if( $model->job_status_id < 100 )
		/*THIS LOCKsJOBS with status greater than 100 to edit */
		{ 
			if(isset($_POST['Servicecall']))
			{
				//echo "I M HERE<br>";

				$previous_status_id = $model->job_status_id;
				//echo "Id before getting form values = ".$previous_status_id."<br>";
				
				$model->attributes=$_POST['Servicecall'];
				
				$current_status_id = $model->job_status_id;
				//echo "id after getting values = ".$current_status_id;
				
				if($model->save())
				{
					$this->redirect(array('view','id'=>$model->id));
					//echo "saved";
				}
				else
				{
				echo "Not Save";
				
				}

			if($previous_status_id != $current_status_id)
				{
					//echo "Status Changed....";
					$this->mailSettings($model->id);
				}
				
			}//end of if(isset()).
		
		}/////end of if( $model->job_status_id < 100 )
		else {
			
			$this->redirect(array('view','id'=>$model->id));
				
		
		}
	
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
	
//	public function actionUpdateServicecall()
//	{
//    	$model=new Servicecall('update');
//
//	    // uncomment the following code to enable ajax-based validation
//	    /*
//	    if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-updateServicecall-form')
//	    {
//	        echo CActiveForm::validate($model);
//	        Yii::app()->end();
//	    }
//	    */
//	
//	    if(isset($_POST['Servicecall']))
//	    {
//	        $model->attributes=$_POST['Servicecall'];
//	       
//	        if($model->validate())
//	        {
//	        	// form inputs are valid, do something here
//	            return;
//	        }
//	    }
//	    $this->render('updateServicecall',array('model'=>$model));
//	}//end of updateServicecall.

		
	public function actionPrintAllJobsForDay()
	{
		$engg_id=$_GET['engg_id'];
		$visit_date=$_GET['date'];
//		$visit_date='14-3-2012';
		
		$mysql_visit_date=strtotime($visit_date);
		
		$service_id_list=Enggdiary::model()->fetchDiaryDetails($engg_id, $mysql_visit_date);
		
		$config= Config::model()->findByPk(1);	
		
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		
		$content='';
		foreach ($service_id_list as $data)
		{
			$servicecall_id= $data->servicecall_id;
			$model=$this->loadModel($servicecall_id);
			$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,'config'=>$config), true));
		}
		
		$mPDF1->Output();
	}//end of printAllJobs.
	
	public function actionAddProduct($cust_id)
	{
		$model = new Servicecall;
		$model->job_status_id=1;
		
		$productModel = new Product;
	
		if(isset($_POST['Product']))
		{
			$productModel->customer_id=$cust_id;
			$productModel->attributes=$_POST['Product'];
			if($productModel->save())
				echo "saved";
				//$this->redirect(array('view','id'=>$model->id));
		}
		
		// uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-addProduct-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	
	    if(isset($_POST['Servicecall']))
	    {
	    	
	     	$model->customer_id=$cust_id;
	     	$model->product_id=$productModel->id;
	     	$model->engineer_id=$productModel->engineer_id;
	     	$model->contract_id=$productModel->contract_id;
	        $model->attributes=$_POST['Servicecall'];
	        if($model->validate())
	        {
	        
	        	if($model->save())
				{
					//echo $model->product_id;
					$engg_id=$model->engineer_id;
					$baseUrl=Yii::app()->request->baseUrl;
					$this->redirect($baseUrl.'/enggdiary/create/'.$model->id.'?engineer_id='.$engg_id);
					//echo "saved";
	            	// form inputs are valid, do something here
	            	//return;
	        	}
	        	else 
	        	{
	        		echo "not saved";
	        	}
	    	}
	    }
	    $this->render('addProduct',array('model'=>$model));
	}//end of addProduct().
	
	public function actionFreeSearch()
    {
    	//WE ARE SEARCHING IN CUSTOMER TABLE, SO CREATING INSTANCE OF CUSTOMER MODEL.
        $model=new Servicecall('search');
        $this->render('freeSearch',array('model'=>$model));
    }//end of freeSearch().
    
    public function actionSearchEngine($keyword)
    {
      //echo "THIS IS IAJAXX  ".$keyword;
 
        $model=new Servicecall();
        $model->unsetAttributes();  // clear any default values
        $results=$model->freeSearch($keyword);
        //echo 'Results '.$results;
        //echo count($results->getData());
        //echo getItemCount

         $customer_search_data = Customer::model()->freeSearch($keyword);
   
        $this->renderPartial('_ajax_search',array(
	                'results'=>$results, 'customer_results'=>$customer_search_data,
	        ));
	        
       // echo "<hr>NEW:   ".$GLOBALS['my_gbp'];
        
//        foreach ($GLOBALS['service_cust_id_list'] as $id)
//        {
//        	echo "<hr> Id:  ".$id;       
//        }
        
       
 
 //       $GLOBALS['service_cust_id_list']=array();
//        $this->renderPartial('/customer/_ajax_search',array(
//	                'results'=>$customer_search_data, 
//	        ));
        
        
        
        
        $cust_id_from_service_results= array();
        
        
   /*     
        if(count($results->getData()) == 0)
        {
        	//echo "no data";
        	//$this->render('Customer/searchEngine', array('keyword'=>$keyword));
 //       	$this->redirect(array('Customer/searchEngine', 'keyword'=>$keyword));
        	
        }
        else 
        {
//        	$service_search_results=$results->getData();
//        	foreach ($service_search_results as $data)
//        	{
//        		array_push($cust_id_from_service_results, $data->customer->id );
//        	}
        	//echo count($cust_id_from_service_results);
        	
        	$this->renderPartial('_ajax_search',array(
	                'results'=>$results,
	        ));
        }
        
 */       
        
//        $customerModel=Customer::model();
//        $customer_search_data = Customer::model()->freeSearch($keyword);
//        if(count($customer_search_data->getData())==0)
//        {
//        	echo "No Data";
//        }
//        else 
//        {
//        	//echo "Data is thr";
//        	
//        }
//        
 }//end of searchEngine().
    
	public function actionGetitems()
	{
//		$model=new Servicecall('search');
//			$id = $_GET['master_id'];
//			$service_id = $_GET['service_id'];
//			echo "master id from get items action = ".$id."<br>";
//			echo "service id in get items action = ".$service_id."<br>";
			
			//$server_items_url='http://localhost/KRUTHIKA/fitlist/spares_diary/masterItems/SearchEngine?keyword='.$id;
			
//			$itemDetails="localhost/KRUTHIKA/fitlist/spares_diary/masterItems/SendJsonData?id=".$id;
//			$server_msg = Servicecall::model()->curl_file_get_contents($itemDetails, true);
//			echo $server_msg."<hr>";
//			
//			$decodedata = json_decode($server_msg, true);
//			echo $decodedata['master_id']."<br>";
//			echo $decodedata['part_num']."<br>";
//			echo $decodedata['opn']."<br>";
//			echo $decodedata['part_name']."<br>";
			
			$this->render('addToSpares');
			
			
	}//end of getItems().
	
	public function mailSettings($id)
	{
		if(!$conn = @fsockopen("google.com", 80, $errno, $errstr, 30))
		{
			echo "PLEASE CHECK YOUR INTERNET CONNECTION";
		}
		else 
		{
			
			//echo "INTERNET IS CONNECTED";
			
			//echo "id = ".$id."<br>";
			
			$setupModel = Setup::model()->findByPk('1');
			//echo $setupModel->email;
			$serviceModel = Servicecall::model()->findByPk($id);
			//echo $serviceModel->customer_id;
			
			$customerModel = Customer::model()->findByPk($serviceModel->customer_id);
			//echo "email = ".$customerModel->email;
			
			$str = "Your service call with REF.No:".$serviceModel->service_reference_number." status has changed to ".$serviceModel->jobStatus->name;
			//echo $str;
			
			//$reciever_email='mailtest.test10@gmail.com';
			$reciever_email = $customerModel->email;
			//$sender_email='mailtest.test10@gmail.com';
			$sender_email=$setupModel->email;
			
			$message = new YiiMailMessage();
			$message->setTo(array($reciever_email));
		    $message->setFrom(array($sender_email));
		    $message->setSubject('Test');
			$message->setBody($str);
			if(Yii::app()->mail->send($message))
		   	{
		   		//echo "TEST EMAIL IS SENT, CONNECTION IS OK<br>"; 
		   	}
		   	
		}//end of else.
		
	}//end of mailSettings().
	

	
}//end of class.

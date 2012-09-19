<?php 

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';
 
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array();
    }
 
    // Actions
    
	public function actionViewFullDiaryJsonData($engg_id)
    {
    	//echo "ENGG ID IN API CONTROLLER = ".$engg_id."<br>";
    	$diary_events_array = array();
		$mydata=array();
		
		
		
		
		if($engg_id == '0')
		{
			//echo "value is zero"."<br>";
			
		/*** CODE TO DISPLAY ALL THE ENGINEERS APPOINTMENTS THIS PART IS CALLED WHEN ENGG_ID=0 ***/
		
			$diaryModel = Enggdiary::model()->findAll();
	    	$i=1;
	    	foreach ($diaryModel as $data)
	    	{
	    		if($data->status!= '102')
	    		{
		    		//echo $data->servicecall_id;
		    		$customer_name=$data->servicecall->customer->fullname;
		    		$customer_postcode=$data->servicecall->customer->postcode;
		    		$engineer_name = $data->engineer->fullname;
		    		$engineer_name = $data->engineer->fullname;
		    		
		    		$start_date= date("Y-m-d H:i",$data->visit_start_date);
		    		$end_date = date("Y-m-d H:i",$data->visit_end_date);
		    		
		    		$diary_events_array['id'] = $data->id;///id of the engg diary
		    		$diary_events_array['service_id'] = $data->servicecall_id;
					$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name." "; ///** HERE WE WIL DISPLAY custtomer name and postcode
					$diary_events_array['start'] = $start_date;
					$diary_events_array['end'] = $end_date;
		    		$diary_events_array['url'] = Yii::app()->baseUrl."/Servicecall/".$data->servicecall_id;
		    		$diary_events_array['allDay'] = false ;
		    		$diary_events_array['textColor'] = "white" ;
	 
		    		array_push($mydata,$diary_events_array);
		    		$i++;
	    		}//end of displaying only those appointments that are not cancelled 
	    		
	    	}//end of foreach().
	    	echo json_encode($mydata);
			/***** END OF CODE TO DISPLAY ALL THE ENGINEERS APPOINTMENTS **********/
		
		}//end of if engg_id value is zero.
		else
		{
			//echo "value is ".$engg_id."<br>";
			
		/*** CODE TO DISPLAY SPECIFIC ENGG DIARY, THIS CODE IS CALLED WHEN ENGG_ID!=0 ***/
			
			$diaryModel = Enggdiary::model()->findAllByAttributes(
												array('engineer_id'=>$engg_id)
											);
			
	    	$i=1;
	    	foreach ($diaryModel as $data)
	    	{
	    		if($data->status!= '102')
	    		{
		    		//echo $data->servicecall_id;
		    		$customer_name=$data->servicecall->customer->fullname;
		    		$customer_postcode=$data->servicecall->customer->postcode;
		    		$engineer_name = $data->engineer->fullname;
		    		
		    		$start_date= date("Y-m-d H:i",$data->visit_start_date);
		    		$end_date = date("Y-m-d H:i",$data->visit_end_date);
		    		
		    		$diary_events_array['id'] = $data->id;///id of the engg diary
		    		$diary_events_array['service_id'] = $data->servicecall_id;
					$diary_events_array['title'] = $customer_name." ".$customer_postcode."\n ".$engineer_name." "; ///** HERE WE WIL DISPLAY custtomer name and postcode
					$diary_events_array['start'] = $start_date;
					$diary_events_array['end'] = $end_date;
		    		$diary_events_array['url'] = Yii::app()->baseUrl."/Servicecall/".$data->servicecall_id;
		    		$diary_events_array['allDay'] = false ;
		    		//'end' => "$year-$month-22",
		    		 
					//echo "id = ".$data->id."<br>";
					//echo "Visit date = ".$date."<br>";
					//echo "service_id = ".$data->servicecall_id."<hr>";
		    		
		    		array_push($mydata,$diary_events_array);
		    		$i++;
	    		}//end of if, displaying only those that are not cancelled.
	    		
	    	}//end of foreach().
	    	echo json_encode($mydata);
			
		/*** END OF CODE TO DISPLAY SPECIFIC ENGG DIARY, THIS CODE IS CALLED WHEN ENGG_ID!=0 ***/

		}//end of else of engg id value == 0.
    	
    }//end of displayDiary().
    
    public function actionUpdateDiary()
    {
    	//echo "IN ACTION UPDATE DIARY<br>";
    	$diary_id = $_GET['diary_id'];
    	echo "Diary id = ".$diary_id."<br>";
    	$days_moved = $_GET['days_moved'];
    	echo "days moved = ".$days_moved;
    	$minutes_moved = $_GET['minutes_moved'];
    	echo "<br> Minutes moved = ".$minutes_moved;
    	//echo "Days moved in api contr = ".$days_moved."<br>";
//    	$end_date = $_GET['end_date'];
//    	echo "end days in api contr = ".$end_date;
    	
//    	if($model = 'Enggdiary')
//    	{
    		//echo "enggdiary is sent<br>";
    		Enggdiary::model()->updateAppointment($diary_id, $days_moved, $minutes_moved);
    	//}
    	
    }//end of updateDiary().
    
    
    
    
    public function actionUpdateEndDateTime()
    {
    	
    	echo "in action update actionUpdateEndDateTime<br>";
    	
    	$diary_id = $_GET['diary_id'];
    	echo "Diary id = ".$diary_id."<br>";
    	$minutes = $_GET['minutes'];
    	echo "minutes in model func = ".$minutes."<br>";
    	
    	Enggdiary::model()->updateEndDateTime($diary_id, $minutes);
    	
    	
    }//end of UpdateMinutes().
    
    public function actionDisplayEngineerId()
    {
    	$diary_events_array = array();
		$mydata=array();
		
		$model=Enggdiary::model();
    	
    	$model->attributes=$_POST['Enggdiary'];
    	 //echo $model->engineer_id;
    	echo "ENGINEER ID IN CONTROLLER :".$model->engineer_id."<br>";
    	$engg_id = $model->engineer_id;
    	
    	 //$this->forward('viewFullDiaryJson/'); 
    	
    	/*
    	
    	$enggAppointmentData = Enggdiary::model()->findAllByPk($engg_id);
    	
    	
    	$i=1;
		foreach ($enggAppointmentData as $data)
    	{
    		$customer_name=$data->servicecall->customer->fullname;
    		$customer_postcode=$data->servicecall->customer->postcode;
    		
    		$start_date= date("Y-m-d H:i",$data->visit_start_date);
    		$end_date = date("Y-m-d H:i",$data->visit_end_date);
    		
    		$diary_events_array['id'] = $data->id;///id of the engg diary
    		$diary_events_array['service_id'] = $data->servicecall_id;
			$diary_events_array['title'] = $customer_name." ".$customer_postcode; ///** HERE WE WIL DISPLAY custtomer name and postcode
			$diary_events_array['start'] = $start_date;
			$diary_events_array['end'] = $end_date;
    		$diary_events_array['url'] = Yii::app()->baseUrl."/Servicecall/".$data->servicecall_id;
    		$diary_events_array['allDay'] = false ;
    		
    		echo "start date = ".date('d-m-Y H:i',$data->visit_start_date)."<br>";
    		echo "Service id = ".$data->servicecall_id."<br>"; 
    		echo "Customer name = ".$data->servicecall->customer->fullname."<br>";
    		
    		array_push($mydata,$diary_events_array);
    		$i++;
    		
    	}//end of foreach().
    	
    	echo json_encode($mydata);
    	
    	*/
    	
    	 
    }//end of actionDisplayEngineerId().
    
    public function actionCreateNewDiaryEntry()
    {
    	echo "IN CreateNewDiaryEntry action";
    	echo "<hr>START DATE = ".date('d-m-Y H:i','1346313600')."<hr>";
    	
    	$start_date = $_GET['start_date'];
    	echo "<br>START DATE = ".$start_date;
    	echo "<br>STRTOTIME START DATE = ".strtotime($start_date);
    	
    	$engg_id = $_GET['engg_id'];
    	echo "<br>ENGG_ID in api contr = ".$engg_id;
    	$service_id = $_GET['service_id'];
    	echo "<br>SERVICE_ID in api contr = ".$service_id;
    	

    	$diaryModel = Enggdiary::model()->findAllByAttributes(
                                array('servicecall_id'=>$service_id), 
                                "status = 3" 
                            );				
		foreach ($diaryModel as $data)
		{
			echo "<hr>Serviecall id from controller = ".$data->servicecall_id;
			echo "<br>engineer name = ".$data->engineer->fullname;
				
			$findDiaryModel = Enggdiary::model()->findByPk($data->id);
				
			$updateDiaryModel = Enggdiary::model()->updateByPk($findDiaryModel->id,
												array(
													'status'=>'102',
													'modified'=>time()
												)
											);
		}//end of foreach().                            
    	
   	
    	
    	$newEnggDiaryModel = new Enggdiary;
    	$newEnggDiaryModel->servicecall_id=$service_id;
		$newEnggDiaryModel->engineer_id=$engg_id;
		$newEnggDiaryModel->status='3';//STATUS OF APPOINTMENT TO BOOKED(VISIT START DATE).
		$newEnggDiaryModel->visit_start_date=$start_date;
		$newEnggDiaryModel->slots = '2';
		
		if($newEnggDiaryModel->save())
		{
			echo "<br>SAVED.......!!!!!!!!!!";
		}
		else 
		{
			echo "<br>Problem in saving";
		}
    	
    	
    	/*** ADDING MINUTES TO STRAT DATE IS NOT NEEDED AS WE WILL ADD IN BEFORE SAVE***
    	$str_time = strtotime($start_date);
    	echo "<br>NORMAL TIME START DATE = ".date('d-m-Y H:i',$str_time);
    	$strat_time_to_pass = date('d-m-Y H:i',$str_time);
    	echo "<br>START DATE to pass  = ".$start_date;
    	
    	$updated_start_time = date("d-m-Y H:i", strtotime('+540 minutes', $str_time));
    	
    	echo "<br>START DATE AFTER ADDING MIN = ".$updated_start_time;
    	$str_updated_start_time = strtotime($updated_start_time);
    	echo "<br>STR UPDATED STRAT TIME = ".$str_updated_start_time;
    	
    	$updated_end_date = date("d-m-Y H:i", strtotime('+1 hour', $str_updated_start_time));
    	echo "<br>END DATE AFTER ADDING MIN = ".$updated_end_date;
    	$str_updated_end_time = strtotime($updated_end_date);
    	echo "<br>STR UPDATED END TIME = ".$str_updated_end_time;
    	*/
    	
    }//end of actionCreateNewDiaryEntry().
    
    public function actionGetAllBookedAppointment()
    {
    	
    	//echo "actionGetAllBookedAppointment is called ";
    	$diary_events_array = array();
		$mydata=array();
    	
    	
    	$diaryModel = Enggdiary::model()->findAll();
	    $i=1;
	    foreach ($diaryModel as $data)
	    {
	    	if($data->status!='102')
	    	{
//		    	echo "<hr>Engg diary id = ".$data->id;
//		    	echo "<br> Engg name = ".$data->engineer->fullname;
//		    	echo "<br>servicecall id = ".$data->servicecall_id;
//		    	echo "<br>Appt start time = ".date('Y-m-d H:i', $data->visit_start_date);
//		    	echo "<br>Appt end time = ".date('Y-m-d H:i', $data->visit_end_date);
		    	
		    	$diary_events_array['title'] = 'Booked';
		    	$diary_events_array['start'] = date('Y-m-d H:i', $data->visit_start_date);
		    	$diary_events_array['end'] = date('Y-m-d H:i', $data->visit_end_date);
		    	$diary_events_array['textColor'] = "pink" ;
		    	
		    	array_push($mydata, $diary_events_array);	    	
	    	}//end of displaying only those appointmens that are not cancelled.
	    }//end of foreach().
	    
	    
	    //echo "<hr>JSON ENCODED DATA <hr>";
	    echo json_encode($mydata); 
    	
    }//end of actionGetAllBookedAppointment().
    
    public function actionList()
    {
    }
    
    public function actionView()
    {
    }
    public function actionCreate()
    {
    }
    public function actionUpdate()
    {
    }
    public function actionDelete()
    {
    }
    
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
    	// set the status
    	$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    	header($status_header);
    	// and the content type
    	header('Content-type: ' . $content_type);
    
    	// pages with body are easy
    	if($body != '')
    	{
    		// send the body
    		echo $body;
    		exit;
    	}
    	// we need to create the body if none is passed
    	else
    	{
    		// create some body messages
    		$message = '';
    
    		// this is purely optional, but makes the pages a little nicer to read
    		// for your users.  Since you won't likely send a lot of different status codes,
    		// this also shouldn't be too ponderous to maintain
    		switch($status)
    		{
    		case 401:
    		$message = 'You must be authorized to view this page.';
    		break;
    		case 404:
    		$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
    		break;
    		case 500:
    		$message = 'The server encountered an error processing your request.';
    		break;
    		case 501:
    		$message = 'The requested method is not implemented.';
    		break;
    	}
    
    		// servers don't always have a signature turned on
    		// (this is an apache directive "ServerSignature On")
    		$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
    
    		// this should be templated in a real-world solution
    		$body = '
    		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    		<html>
    		<head>
    		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    		<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
    		</head>
    		<body>
    		<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    		<p>' . $message . '</p>
    		<hr />
    		<address>' . $signature . '</address>
    </body>
    </html>';
    
    echo $body;
    exit;
    }
    }///end of function send Response
    
    private function _getStatusCodeMessage($status)
    {
    	// these could be stored in a .ini file and loaded
    	// via parse_ini_file()... however, this will suffice
    	// for an example
    	$codes = Array(
    			200 => 'OK',
    			400 => 'Bad Request',
    			401 => 'Unauthorized',
    			402 => 'Payment Required',
    			403 => 'Forbidden',
    			404 => 'Not Found',
    			500 => 'Internal Server Error',
    			501 => 'Not Implemented',
    	);
    	return (isset($codes[$status])) ? $codes[$status] : '';
    }///end of function getStatusCodeMessages
    
 private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if(!(isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME']) and isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD']))) {
            // Error: Unauthorized
            
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME'];
        $password = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD'];
        // Find the user
        $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }//end of function checkAuth
    
    
    
}///end of class 
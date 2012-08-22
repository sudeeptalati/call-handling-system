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
    
	public function actionViewFullDiaryJsonData()
    {
    	$diary_events_array = array();
		$mydata=array();
		
    	$diaryModel = Enggdiary::model()->findAll();
    	$i=1;
    	foreach ($diaryModel as $data)
    	{
    		//echo $data->servicecall_id;
    		$customer_name=$data->servicecall->customer->fullname;
    		$customer_postcode=$data->servicecall->customer->postcode;
    		
    		$start_date= date("Y-m-d H:i",$data['visit_start_date']);
    		$end_date = date("Y-m-d H:i",$data['visit_end_date']);
    		
    		$diary_events_array['id'] = $data->id;///id of the engg diary
    		$diary_events_array['service_id'] = $data->servicecall_id;
			$diary_events_array['title'] = $customer_name." ".$customer_postcode; ///** HERE WE WIL DISPLAY custtomer name and postcode
			$diary_events_array['start'] = $start_date;
			$diary_events_array['end'] = $end_date;
    		$diary_events_array['url'] = Yii::app()->baseUrl."/Servicecall/".$data->servicecall_id;
    		$diary_events_array['allDay'] = false ;
    		//'end' => "$year-$month-22",
    		 
//			echo "id = ".$data->id."<br>";
//			echo "Visit date = ".$date."<br>";
//			echo "service_id = ".$data->servicecall_id."<hr>";
    		
    		array_push($mydata,$diary_events_array);
    		$i++;
    		
    	}//end of foreach().
    	echo json_encode($mydata);
    	
    }//end of displayDiary().
    
    public function actionUpdateDiary()
    {
    	//echo "IN ACTION UPDATE DIARY<br>";
    	$engg_id = $_GET['engg_id'];
    	//echo "Diary id = ".$engg_id."<br>";
    	$days_moved = $_GET['days_moved'];
    	//echo "Days moved in api contr = ".$days_moved."<br>";
    	
    	
//    	if($model = 'Enggdiary')
//    	{
    		//echo "enggdiary is sent<br>";
    		Enggdiary::model()->updateAppointment($engg_id, $days_moved);
    	//}
    	
    }//end of updateDiary().
    
    
    
    
    public function actionUpdateEndDateTime()
    {
    	
    	echo "in action update actionUpdateEndDateTime<br>";
    	
    	$engg_id = $_GET['engg_id'];
    	echo "Diary id = ".$engg_id."<br>";
    	$minutes = $_GET['minutes'];
    	echo "minutes in model func = ".$minutes."<br>";
    	
    	Enggdiary::model()->updateEndDateTime($engg_id, $minutes);
    	
    	
    }//end of UpdateMinutes().
    
    
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
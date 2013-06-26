<?php

/**
 * This is the model class for table "notification_rules".
 *
 * The followings are the available columns in table 'notification_rules':
 * @property integer $id
 * @property integer $job_status_id
 * @property string $active
 * @property integer $customer_notification_code
 * @property integer $engineer_notification_code
 * @property integer $warranty_provider_notification_code
 * @property string $notify_others
 * @property string $created
 * @property string $modified
 * @property string $delete
 *
 * The followings are the available model relations:
 * @property JobStatus $jobStatus
 * @property NotificationCode $warrantyProviderNotificationCode
 * @property NotificationCode $engineerNotificationCode
 * @property NotificationCode $customerNotificationCode
 */
class NotificationRules extends CActiveRecord
{
	public $status_changed;
	public $customer_notification;
	public $engineer_notification;
	public $warranty_provider_notification;
	public $created;
	public $custom_column;
			
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationRules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notification_rules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_status_id', 'required'),
			array('job_status_id, customer_notification_code, engineer_notification_code, warranty_provider_notification_code', 'numerical', 'integerOnly'=>true),
			array('active, notify_others, created, modified, delete', 'safe'),
			array('job_status_id','unique','message'=>'{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_status_id, active, customer_notification_code, engineer_notification_code, warranty_provider_notification_code, notify_others, created, modified, delete', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'job_status_id'),
			'warrantyProviderNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'warranty_provider_notification_code'),
			'engineerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'engineer_notification_code'),
			'customerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'customer_notification_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_status_id' => 'Job Status',
			'active' => 'Enabled',
			'customer_notification_code' => 'Customer ',
			'engineer_notification_code' => 'Engineer ',
			'warranty_provider_notification_code' => 'Warranty Provider ',
			'notify_others' => 'Notify Others',
			'created' => 'Created on',
			'modified' => 'Last Modified on',
			'delete' => 'Delete',
		);
	}
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('jobStatus');
		$criteria->compare( 'jobStatus.name', $this->status_changed, true );

		$criteria->compare('id',$this->id);
		$criteria->compare('job_status_id',$this->job_status_id);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('customer_notification_code',$this->customer_notification_code);
		$criteria->compare('engineer_notification_code',$this->engineer_notification_code);
		$criteria->compare('warranty_provider_notification_code',$this->warranty_provider_notification_code);
		$criteria->compare('notify_others',$this->notify_others,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('delete',$this->delete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
        		if($this->notify_others == 1)
        		{
        			$notificationContactModel = NotificationContact::model()->findAllByAttributes(array('notification_code_id'=>$this->id));
        			if(count($notificationContactModel) == 0)
        			{
        				$this->notify_others = 0;
        			}//end of if count().
        		}//end of if notify_others == 1.
        		
        		return true;
            }//END OF IF NEW RECORD.
            else
            {
            	$this->modified=time();
            	
            	if($this->notify_others == 1)
            	{
            		$notificationContactModel = NotificationContact::model()->findAllByAttributes(array('notification_code_id'=>$this->id));
            		if(count($notificationContactModel) == 0)
            		{
            			$this->notify_others = 0;
            		}//end of if count().
            	}//end of if notify_others == 1.
            	
                return true;
            }//END OF ELSE, THIS BIT IS CALLED IN UPDATE.
            
        }//end of if(parent())
    }//end of beforeSave().
    
	
    public function getNotificationCode($email_status,$sms_status)
	{
		$email_value;
		$sms_value;
		/**RETURNING CODE IS (Refer Table) 
		 * 	0- NONE
		 * 	1- Email Only
		 *  2- SMS Only
		 *  3- Email & SMS
		 * */
		//echo "in model method";
		$emailNotificationCodeModel = NotificationCode::model()->findByAttributes(
																array(
																'notify_by'=>'email'
															));
		//echo "<hr>EMAIL id got from db using findall = ".$emailNotificationCodeModel->id;	
		$emailNotifyId = $emailNotificationCodeModel->id;														
		
		$smsNotificationCodeModel = NotificationCode::model()->findByAttributes(
																array(
																'notify_by'=>'sms'
															));
		//echo "<hr>SMS id got from db using findall = ".$smsNotificationCodeModel->id;
		$smsNotifyId = $smsNotificationCodeModel->id;
		
		if ($email_status==true)
		{
			//$email_value=1;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'email' *//
			$email_value = $emailNotifyId;
		}
		else
		{ 
			$email_value=0;
		}
		
		if ($sms_status==true)
		{
			//$sms_value=2;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'sms' *//
			$sms_value = $smsNotifyId;
		}
		else
		{ 
			$sms_value=0;
		}
		
		$notification_code=$email_value+$sms_value;
		return $notification_code;

					
	}///end of function getNotificationCode($email_status,$sms_status)
	
	public function getEmailCheckBoxStatus($notification_code)
	{
		switch($notification_code) { 
			
			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return true;
				break;
			case 2://*Since SMS only is value of 1*//
				return false;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;
			
		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)
	
	
	public function getSMSCheckBoxStatus($notification_code)
	{
		switch($notification_code) { 
			
			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return false;
				break;
			case 2://*Since SMS only is value of 1*//
				return true;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;
			
		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)
	
	public function notifyByEmailAndSms($receiver_email_address, $telephone, $notificaionCode, $body, $subject, $smsMessage)
	{
		//echo "<br>Receiver email addresss = ".$receiver_email_address;
		//echo "<br>Telephone no = ".$telephone;
		//echo "<br>Notification code in model = ".$notificaionCode;
		$response_array = array();
		switch ($notificaionCode)
		{
			case 1:
				//echo "<br>Send email";
				$email_response = NotificationRules::sendEmail($receiver_email_address, $body, $subject);
				$response_array['sms_response']= 'none';
				$response_array['email_response']= $email_response;
				return $response_array;
				break;
			case 2:
				//echo "<br>Send SMS";
				$sms_response = NotificationRules::sendSMS($telephone, $smsMessage);
				//echo "<br> sms notification message in model = ".$sms_response;
				$response_array['sms_response']= $sms_response;
				$response_array['email_response']= 'none';
				return $response_array;
				break;
			case 3:
				//echo "<br>Send email and SMS also";
				$sms_response = NotificationRules::sendSMS($telephone, $smsMessage);
				$email_response = NotificationRules::sendEmail($receiver_email_address, $body, $subject);
				//echo "<br> sms notification message in model = ".$sms_response;
				$response_array['sms_response']= $sms_response;
				//echo "<br>TYPE OF RESPONSE IN MODEL FUNC = ".gettype($sms_response);
				$response_array['email_response']= $email_response;
				return $response_array;
				break;
		}//end of switch().
		
	}//end of sendCustomerEmailAndSms().
	
	
	public function sendEmail($reciever_email_address, $body, $subject)
	{
		$email_response = '';
		$root = dirname(dirname(__FILE__));
		$email_body = $body;
		//echo $root."<br>";
		$filename = $root.'/config/mail_server.json';
			
		$reciever_email=$reciever_email_address;
		$sender_email='';
			
		if(file_exists($filename))
		{
			//echo "<hr>json File with email details is present";
			$data = file_get_contents($filename);
			$decodedata = json_decode($data, true);
			//echo "<br>Username = ".$decodedata['smtp_username'];
			$sender_email = $decodedata['smtp_username'];
		}
		
		if(!$conn = @fsockopen("google.com", 80, $errno, $errstr, 30))
		{
			//echo "PLEASE CHECK YOUR INTERNET CONNECTION";
		}//end of inner if().
		else
		{
			try 
			{
				//echo "<br>Inernet Connection present";
				//echo "<br>Sender email = ".$sender_email;
				//echo "<br>Receiver email = ".$reciever_email;
	
	 			$message = new YiiMailMessage();
				$message->setTo(array($reciever_email));
				$message->setFrom(array($sender_email));
				$message->setSubject($subject);
				$message->setBody($email_body, 'text/html');
			
				if(Yii::app()->mail->send($message))
				{
					//echo "<br>TEST EMAIL IS SENT, CONNECTION IS OK";
					$email_response = 1;
				}
			}//end of try.
			catch (Exception $e)
			{
				$email_response = 0;
			}
		}//end of else.
		return $email_response;
		
	}//end of sendEmail().
	
	public function sendSMS($mobileNumber, $smsMessage)
	{
		//echo "sendSMS func called";
		//Yii::app()->sms->send(array('to'=>'447550508559', 'message'=>$smsMessage));
		$response = Yii::app()->sms->send(array('to'=>$mobileNumber, 'message'=>$smsMessage));
		//print_r($response);
		
		if(isset($response[1]))
		{
			//echo "<br>error mesg = ".$response[1];
			return $response[1];
		}
		
		else 
			return true;
		
	}//end of sendSMS().
	
	
}//end of class.
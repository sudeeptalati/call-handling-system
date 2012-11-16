<?php

/**
 * This is the model class for table "enggdiary".
 *
 * The followings are the available columns in table 'enggdiary':
 * @property integer $id
 * @property integer $engineer_id
 * @property string $visit_start_date
 * @property string $visit_end_date
 * @property integer $slots
 * @property integer $servicecall_id
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 * @property string $status
 * @property string $notes
 
 * * The followings are the available model relations:
 * @property Enginner $engineer
 * @property Servicecall $servicecall
 * @property User $userid
 */
class Enggdiary extends CActiveRecord
{
	public $engineer_name;
	public $date_of_visit;
	public $appointment_status;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Enggdiary the static model class
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
		return 'enggdiary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visit_start_date, servicecall_id', 'required'),
			array('engineer_id, slots, servicecall_id, user_id', 'numerical', 'integerOnly'=>true),
			array('visit_end_date, modified, status, notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, engineer_id, visit_start_date, visit_end_date, slots, servicecall_id, user_id, created, modified, notes', 'safe', 'on'=>'search'),
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
		'engineer' => array(self::BELONGS_TO, 'Engineer', 'engineer_id'),
		'servicecall' => array(self::BELONGS_TO, 'Servicecall', 'servicecall_id'),
		'userid' => array(self::BELONGS_TO, 'User', 'user_id'),
		'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'status'),
		
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'engineer_id' => 'Engineer',
			'visit_start_date' => 'Date of Visit',
			'visit_end_date' => 'Visit End Date',
			'slots' => 'Number of Slots',
			'servicecall_id' => 'Servicecall',
			'user_id' => 'User',
			'created' => 'Created',
			'modified' => 'Modified',
			'status' => 'Appointment Status',
			'notes' => 'Notes',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('engineer_id',$this->engineer_id);
		$criteria->compare('visit_start_date',$this->visit_start_date,true);
		$criteria->compare('visit_end_date',$this->visit_end_date,true);
		$criteria->compare('slots',$this->slots);
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	//echo $this->slots."<br>";
        	$prod = $this->slots*30;
        	//echo $prod;
        	if($this->isNewRecord)  // Creating new record 
            {
            	
            	/****** ADDING MINUTES TO START DATE TO MAKE IT 9 AM ******/
            	$phpdate = strtotime($this->visit_start_date);
            	$new_date = date("d-m-Y H:i:s", strtotime('+540 minutes', $phpdate));
            	$this->visit_start_date = strtotime($new_date);
            	/****** END OF ADDING MINUTES TO START DATE TO MAKE IT 9 AM ******/
            	
            	/****** ADDING SLOT DURATION TO END TIME *******/
				//echo "<br>start time after adding min = ".$this->visit_start_date;
				$added_end_date = date("d-m-Y H:i:s", strtotime($prod.'minutes', $this->visit_start_date));            	
            	//echo "<br>end time after adding slot = ".$added_end_date;
            	$this->visit_end_date = strtotime($added_end_date);
            	/****** END OF ADDING SLOT DURATION TO END TIME *******/

			//	$this->user_id=Yii::app()->user->id;
        		$this->user_id="1";
        		$this->created=time();
            	$this->notes = "An appointment is created on ".date('d-m-Y H:i', $this->visit_start_date)." by ".$this->userid->name.".";
        		
        		//SAVING CHANGED ENGG_ID TO SERVICE TABLE.
        		$serviceQueryModel = Servicecall::model()->findByPk($this->servicecall_id);
        		
        		$serviceUpdateModel = Servicecall::model()->updateByPk($serviceQueryModel->id,
        													array(
        													'engineer_id'=>$this->engineer_id,
        													)
        													);
				$productQueryModel = Product::model()->findByPk($serviceQueryModel->product_id);
				$productUpdateModel = Product::model()->updateByPk($serviceQueryModel->product_id,
																	array(
																	'engineer_id'=>$this->engineer_id,
																	)
																	);        													
				//echo $serviceUpdateModel->engineer_id;        													
				//$this->engineer_id=$serviceUpdateModel->engineer_id;        													
        		
        		return true;
            }//end of isNewRecord.
            else
            {
            	//echo "visit time in update in before save = ".$this->visit_start_date;
            	console.info("visit time in update in before save = ". $this->visit_start_date);
//            	$this->visit_start_date=strtotime($this->visit_start_date);
//            	$this->visit_end_date=strtotime($this->visit_end_date);
//            	$this->modified=time();
//                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    protected function afterSave()
    {
    	$serviceModel=Servicecall::model()->findByPk($this->servicecall_id);
    	if($serviceModel->job_status_id == '1')
    	{
    		$serviceUpdateModel=Servicecall::model()->updateByPk($serviceModel->id,
    												array(
    												'engg_diary_id'=>$this->id,
    												'job_status_id'=>'3'
    												));
    	}//end of if, changing status of servicecall to booked.
    	elseif($serviceModel->job_status_id == '2')
    	{
    		$serviceUpdateModel=Servicecall::model()->updateByPk($serviceModel->id,
    												array(
    												'engg_diary_id'=>$this->id,
    												));
    	}//end of else, changing status of servicecall to remotely booked.   												
    }//end of afterSave().
    
    public function fetchDiaryDetails($engg_id,$date )
    {
    	//$result=array();
    	return Enggdiary::model()->findAllByAttributes(
    								array('engineer_id'=>$engg_id , 'visit_start_date'=>$date, 'status'=>3));/*WE will only display the active appointmenst*/
    	
    }//end of fetchDiaryDetails(). 
    	
    public function getAllEngineers()
    {
    	return CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
    }
    
    public function getAppointmentStatus($status_code)
    {
    	$str=' ';
    	//echo $status_code;
    	switch ($status_code)
    	{
   			case 0:$str="Cancelled"; break;
    		case 1:$str="Booked"; break;
    	}
    	return $str;
    }
    
    public function weeklyReport($engg_id,$start_date,$end_date)
    {
    	$str_start_date=strtotime($start_date);
    	$str_end_date=strtotime($end_date);
    	
    	return Enggdiary::model()->findAllByAttributes( 
    								array('engineer_id'=>$engg_id, 'status'=>3), "visit_start_date <= $str_end_date AND visit_start_date >= $str_start_date"
    								);
    }//end of weeklyReport.
    
    public function updateAppointment($id, $days_moved, $minutes_moved)
    {
    	
    	 
    	//echo "end date from method in model = ".$end_date."<br>";
    	//echo "NORMAL END date from method in model = ".date("Y-m-d H:i",$end_date)."<br>";
    	echo "<hr>id from method in model = ".$id."<br>";
    	echo "days moved from method in model = ".$days_moved."<br>";
    	echo "minutes moved = ".$minutes_moved;
    	    	
    	$diaryModel = Enggdiary::model()->findAllByPk($id);
    	
    	
    	foreach($diaryModel as $data)
    	{
    		/****** UPDATING START DATE SETTING TIME TO 9 AM *******/
    		echo "<br>******************** DATA FROM MODEL FUNC ***********<br>";
    		echo "satrt date from db = ".date("Y-m-d H:i",$data->visit_start_date)."<br>";
    		$date= date("Y-m-d H:i",$data->visit_start_date);
    		//echo "service call from model = ".$data->servicecall_id."<br>";
    		
    		$updated_start_date = strtotime(date("Y-m-d H:i", $data->visit_start_date) . $days_moved."day". $minutes_moved."minutes");
    		echo "NEW UPDATED DATE AFTER ADDING DAYS = ".date('Y-m-d H:i', $updated_start_date)."<br>";
    		echo "<br>PHP UPDATED START DATE = ".$updated_start_date;
    		$new_start_date = strtotime($updated_start_date);
    		
    		/****** END OF UPDATING START DATE SETTING TIME TO 9 AM *******/
            
            
            /****** UPDATING END DATE WHEN APPO IS CHANGED TO NEXT DAY******/
            
            echo "<br>end date from db = ".date("Y-m-d H:i",$data->visit_end_date);
            $updated_end_date = strtotime(date("Y-m-d H:i", $data->visit_end_date) . $days_moved."day". $minutes_moved."minutes");
            echo "<br>PHP END DATE = ".$updated_end_date;
            echo "<br>NORMAL END DATE = ".date("Y-m-d H:i",$updated_end_date);
            $new_end_date = date("Y-m-d H:i",$updated_end_date);
            echo "<br>******************** END OF DATA FROM MODEL FUNC ***********<br>";
            
            /****** UPDATING END DATE WHEN APPO IS CHANGED TO NEXT DAY******/
            
            $notesStr = $data->notes."\n Appointment has been updated to ".date('d-m-Y H:i', $updated_start_date)." by ".Yii::app()->user->name.".";
            
            $updateDiaryModel = Enggdiary::model()->updateByPk($data->id,
    											array(
    												'visit_start_date'=>$updated_start_date,
    												//'visit_start_date'=>$new_start_date,
    												'visit_end_date'=>$updated_end_date,
    												'notes'=>$notesStr
    											)
    										);
    		
    	}//end of foreach().
    	
    }//end of updateAppointment().
    
    public function updateEndDateTime($id, $minutes)
    {
    	echo "minutes from func in model = ".$minutes."<br>";
    	
    	$enggModel = Enggdiary::model()->findAllByPk($id);
    	
    	foreach ($enggModel as $data)
    	{
    		echo "id from func in model = ".$data->id."<br>";
    		echo "VISIT START DATE = ".date('d-m-Y H:i', $data->visit_start_date)."<br>";	
    		echo "VISIT END DATE = ".date('d-m-Y H:i', $data->visit_end_date)."<br>";
    		$date = strtotime(date("Y-m-d H:i", $data->visit_end_date) . $minutes."minutes");
    		echo "time after adding min = ".date('d-m-Y H:i', $date);
    		$notesStr = $data->notes."\n Appointment end time was changed to ".date('d-m-Y H:i', $date)." by ".Yii::app()->user->name.".";
    		
    		$enggUpdateModel = Enggdiary::model()->updateByPk($id,
    											array(
    											'visit_end_date'=>$date,
    											'notes'=>$notesStr
    											)	
    										);
    	}//end of foreach().

    }//end of updateEndTime(). 
    
    public function changePreviousAppointment($diary_id)
    {
    	$previousDiaryModel = Enggdiary::model()->findByPk($diary_id);
		echo "<hr>Visit start date = ".$previousDiaryModel->visit_start_date;
		echo "<br>Visit end date = ".$previousDiaryModel->visit_end_date;
		echo "<br>No of slots = ".$previousDiaryModel->slots;
		echo "<br>status = ".$previousDiaryModel->status;
		$notesStr = $previousDiaryModel->notes."\n This appointment has been cancelled by ".Yii::app()->user->name.".";
		
		$updateDiaryModel = Enggdiary::model()->updateByPk($previousDiaryModel->id,
													array(
														'status'=>'102',
														'notes'=>$notesStr
													)
												);
    }//end of statusPreviousAppointment.
    
    
    
    
}//end of class.
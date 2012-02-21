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
 
 * * The followings are the available model relations:
 * @property Enginner $engineer
 * @property Servicecall $servicecall
 * @property User $userid
 */
class Enggdiary extends CActiveRecord
{
	public $engineer_name;
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
			array('visit_end_date, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, engineer_id, visit_start_date, visit_end_date, slots, servicecall_id, user_id, created, modified', 'safe', 'on'=>'search'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	
        	
        	$this->visit_start_date=strtotime($this->visit_start_date);
        	$this->visit_end_date=strtotime($this->visit_end_date);
        	if($this->isNewRecord)  // Creating new record 
            {
            	$this->user_id=Yii::app()->user->id;
        		$this->created=time();
        		
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
            }
            else
            {
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    protected function afterSave()
    {
    	$serviceModel=Servicecall::model()->findByPk($this->servicecall_id);
    	$serviceUpdateModel=Servicecall::model()->updateByPk($serviceModel->id,
    												array(
    												'engg_diary_id'=>$this->id,
    												));
    }
    
    public function fetchDiaryDetails($engg_id,$date )
    {
    	//$result=array();
    	return Enggdiary::model()->findAllByAttributes(
    								array('engineer_id'=>$engg_id , 'visit_start_date'=>$date));
    	
    }//end of fetchDiaryDetails(). 
    	
    public function getAllEngineers()
    {
    	return CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
    }
    
}//end of class.
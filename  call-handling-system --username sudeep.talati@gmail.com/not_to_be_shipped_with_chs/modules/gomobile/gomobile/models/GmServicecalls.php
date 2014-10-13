<?php

/**
 * This is the model class for table "gm_servicecalls".
 *
 * The followings are the available columns in table 'gm_servicecalls':
 * @property integer $id
 * @property integer $servicecall_id
 * @property string $mobile_status
 * @property integer $created
 * @property integer $modified
 */
class GmServicecalls extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gm_servicecalls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicecall_id, created, modified', 'numerical', 'integerOnly'=>true),
			array('mobile_status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, servicecall_id, mobile_status, created, modified', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'servicecall_id' => 'Servicecall',
			'mobile_status' => 'Mobile Status',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('mobile_status',$this->mobile_status,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GmServicecalls the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
				
				return true;
            }//end of new record.
            else
            {
            	$this->modified=time();
            	
            	
            	//if()
            	
            	return true;
            }
        }//end of if(parent())
	}///end of beforesave
}

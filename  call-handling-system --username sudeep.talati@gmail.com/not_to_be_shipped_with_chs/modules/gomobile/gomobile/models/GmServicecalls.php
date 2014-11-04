<?php

/**
 * This is the model class for table "gm_servicecalls".
 *
 * The followings are the available columns in table 'gm_servicecalls':
 * @property integer $id
 * @property integer $servicecall_id
 * @property integer $service_reference_number
 * @property integer $mobile_status_id
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
			array('servicecall_id, service_reference_number, mobile_status_id, created, modified', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, servicecall_id, service_reference_number, mobile_status_id, created, modified', 'safe', 'on'=>'search'),
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
			'mobile_status'=>	array(self::BELONGS_TO, 'GmMobileStatus', 'mobile_status_id')
			
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
			'service_reference_number' => 'Service Reference Number',
			'mobile_status_id' => 'Mobile Status',
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
		$criteria->compare('service_reference_number',$this->service_reference_number);
		$criteria->compare('mobile_status_id',$this->mobile_status_id);
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
}
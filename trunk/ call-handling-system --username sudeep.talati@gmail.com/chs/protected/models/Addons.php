<?php

/**
 * This is the model class for table "addons".
 *
 * The followings are the available columns in table 'addons':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $information
 * @property integer $active
 * @property string $created_on
 * @property integer $created_by
 * @property string $inactivated_on
 * @property integer $inactivated_by
 */
class Addons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Addons the static model class
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
		return 'addons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, created_by, inactivated_by', 'numerical', 'integerOnly'=>true),
			array('type, name, information, created_on, inactivated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name, information, active, created_on, created_by, inactivated_on, inactivated_by', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'name' => 'Name',
			'information' => 'Information',
			'active' => 'Active',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'inactivated_on' => 'Inactivated On',
			'inactivated_by' => 'Inactivated By',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('information',$this->information,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('inactivated_on',$this->inactivated_on,true);
		$criteria->compare('inactivated_by',$this->inactivated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "job_status".
 *
 * The followings are the available columns in table 'job_status':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $published
 * @property integer $view_order
 * @property integer $updated_by_user_id
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property User $updatedByUser
 * @property Servicecall[] $servicecalls
 */
class JobStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobStatus the static model class
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
		return 'job_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, published, view_order', 'required'),
			array('published, view_order, updated_by_user_id', 'numerical', 'integerOnly'=>true),
			array('information, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, published, view_order, updated_by_user_id, updated', 'safe', 'on'=>'search'),
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
			'updatedByUser' => array(self::BELONGS_TO, 'User', 'updated_by_user_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'job_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'information' => 'Information',
			'published' => 'Published',
			'view_order' => 'View Order',
			'updated_by_user_id' => 'Updated By User',
			'updated' => 'Updated',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('information',$this->information,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('view_order',$this->view_order);
		$criteria->compare('updated_by_user_id',$this->updated_by_user_id);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
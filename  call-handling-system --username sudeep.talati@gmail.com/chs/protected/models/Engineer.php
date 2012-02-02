<?php

/**
 * This is the model class for table "engineer".
 *
 * The followings are the available columns in table 'engineer':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $active
 * @property string $company
 * @property string $vat_reg_number
 * @property string $notes
 * @property integer $inactivated_by_user_id
 * @property string $inactivated_on
 * @property integer $contact_details_id
 * @property integer $delivery_contact_details_id
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property ContactDetails $deliveryContactDetails
 * @property ContactDetails $contactDetails
 * @property User $createdByUser
 * @property User $inactivatedByUser
 * @property Product[] $products
 * @property Servicecall[] $servicecalls
 */
class Engineer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Engineer the static model class
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
		return 'engineer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, active, contact_details_id, created_by_user_id, created', 'required'),
			array('active, inactivated_by_user_id, contact_details_id, delivery_contact_details_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('company, vat_reg_number, notes, inactivated_on, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, active, company, vat_reg_number, notes, inactivated_by_user_id, inactivated_on, contact_details_id, delivery_contact_details_id, created_by_user_id, created, modified', 'safe', 'on'=>'search'),
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
			'deliveryContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'delivery_contact_details_id'),
			'contactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'contact_details_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'inactivatedByUser' => array(self::BELONGS_TO, 'User', 'inactivated_by_user_id'),
			'products' => array(self::HAS_MANY, 'Product', 'engineer_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'engineer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'active' => 'Active',
			'company' => 'Company',
			'vat_reg_number' => 'Vat Reg Number',
			'notes' => 'Notes',
			'inactivated_by_user_id' => 'Inactivated By User',
			'inactivated_on' => 'Inactivated On',
			'contact_details_id' => 'Contact Details',
			'delivery_contact_details_id' => 'Delivery Contact Details',
			'created_by_user_id' => 'Created By User',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('vat_reg_number',$this->vat_reg_number,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('inactivated_by_user_id',$this->inactivated_by_user_id);
		$criteria->compare('inactivated_on',$this->inactivated_on,true);
		$criteria->compare('contact_details_id',$this->contact_details_id);
		$criteria->compare('delivery_contact_details_id',$this->delivery_contact_details_id);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
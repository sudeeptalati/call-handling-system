<?php

/**
 * This is the model class for table "uplifts".
 *
 * The followings are the available columns in table 'uplifts':
 * @property integer $id
 * @property string $uplift_number
 * @property integer $prefix_id
 * @property integer $servicecall_id
 * @property integer $customer_id
 * @property integer $product_id
 * @property string $product_type
 * @property string $retailer
 * @property string $distributor
 * @property integer $visited_engineer_id
 * @property string $visited_engineer_name
 * @property string $date_of_call
 * @property string $reason_for_uplift
 * @property string $request_type
 * @property string $model_number
 * @property string $serial_number
 * @property string $index_number
 * @property string $date_of_purchase
 * @property integer $authorised_by
 * @property string $postcode
 * @property string $customer_claim_description
 * @property string $notes
 * @property string $created
 * @property string $modified
 * @property integer $created_by
 * @property integer $modified_by
 */
class Uplifts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Uplifts the static model class
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
		return 'uplifts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prefix_id, serial_number,servicecall_id, customer_id, product_id, visited_engineer_id, authorised_by, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('uplift_number, product_type, retailer, distributor, visited_engineer_name, date_of_call, reason_for_uplift, request_type, model_number, serial_number, index_number, date_of_purchase, postcode, customer_claim_description, notes, created, modified', 'safe'),
			array('serial_number', 'required'),
			array('serial_number', 'length', 'is'=>14, 'message'=>'{attribute}:should be of exact 14 charecters-numeric values only!'),
			
			array('serial_number','unique','message'=>'{attribute}:{value} already exists!'),
			
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uplift_number, prefix_id, servicecall_id, customer_id, product_id, product_type, retailer, distributor, visited_engineer_id, visited_engineer_name, date_of_call, reason_for_uplift, request_type, model_number, serial_number, index_number, date_of_purchase, authorised_by, postcode, customer_claim_description, notes, created, modified, created_by, modified_by', 'safe', 'on'=>'search'),
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
			'upliftPrefix' => array(self::BELONGS_TO, 'UpliftsConfig', 'prefix_id'),
			'servicecall' => array(self::BELONGS_TO, 'Servicecall', 'servicecall_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),	
			'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type'),
			'visitedEngineer' => array(self::BELONGS_TO, 'Engineer', 'visited_engineer_id'),
			'authorisedByUser' => array(self::BELONGS_TO, 'User', 'authorised_by'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by'),
			'modifiedByUser' => array(self::BELONGS_TO, 'User', 'modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uplift_number' => 'Uplift Number',
			'prefix_id' => 'Prefix',
			'servicecall_id' => 'Servicecall',
			'customer_id' => 'Customer',
			'product_id' => 'Product',
			'product_type' => 'Product Type',
			'retailer' => 'Retailer',
			'distributor' => 'Distributor',
			'visited_engineer_id' => 'Visited Engineer',
			'visited_engineer_name' => 'Visited Engineer Name',
			'date_of_call' => 'Date Of Call',
			'reason_for_uplift' => 'Reason For Uplift',
			'request_type' => 'Request Type',
			'model_number' => 'Model Number',
			'serial_number' => 'Serial Number',
			'index_number' => 'Index Number',
			'date_of_purchase' => 'Date Of Purchase',
			'authorised_by' => 'Authorised By',
			'postcode' => 'Postcode',
			'customer_claim_description' => 'Customer Claim Description',
			'notes' => 'Notes',
			'created' => 'Created',
			'modified' => 'Modified',
			'created_by' => 'Created By',
			'modified_by' => 'Modified By',
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
		$criteria->compare('uplift_number',$this->uplift_number,true);
		$criteria->compare('prefix_id',$this->prefix_id);
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_type',$this->product_type,true);
		$criteria->compare('retailer',$this->retailer,true);
		$criteria->compare('distributor',$this->distributor,true);
		$criteria->compare('visited_engineer_id',$this->visited_engineer_id);
		$criteria->compare('visited_engineer_name',$this->visited_engineer_name,true);
		$criteria->compare('date_of_call',$this->date_of_call,true);
		$criteria->compare('reason_for_uplift',$this->reason_for_uplift,true);
		$criteria->compare('request_type',$this->request_type,true);
		$criteria->compare('model_number',$this->model_number,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('index_number',$this->index_number,true);
		$criteria->compare('date_of_purchase',$this->date_of_purchase,true);
		$criteria->compare('authorised_by',$this->authorised_by);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('customer_claim_description',$this->customer_claim_description,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
protected function beforeSave()
    {
	
		$this->date_of_call=strtotime($this->date_of_call);
		$this->date_of_purchase=strtotime($this->date_of_purchase);
		$this->serial_number=str_replace(" ", "", $this->serial_number);
		$this->serial_number = strtoupper($this->serial_number);
		
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
			
				$this->uplift_number=UpliftsConfig::model()->getAvailableCodeById($this->prefix_id);
				$this->created_by=Yii::app()->user->id;
        		$this->authorised_by=Yii::app()->user->id;
        		$this->created=time();
        		return true;
            }//end of new record.
            else
            {
				$this->modified_by=Yii::app()->user->id;
            	$this->modified=time();
				return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
	
	
	protected function afterSave()
    {

        	if($this->isNewRecord)  // Creating new record 
            {
				UpliftsConfig::model()->updateNextAvailableCodeById($this->prefix_id);
				return true;
            }//end of new record.
            else
            {
				return true;
            }
	
    }//end of beforeSave().
    
	
	
	public function getProductTypesArray()
	{
		$productTypesArray = array();
		$productTypesResult = ProductType::model()->findAll();
		 
		foreach ($productTypesResult as $data)
		{
			array_push($productTypesArray, $data->name);
		}//end pf foreach.
	
		return $productTypesArray;
		 
	}//end of getAllModelNumbers().

	
	
}
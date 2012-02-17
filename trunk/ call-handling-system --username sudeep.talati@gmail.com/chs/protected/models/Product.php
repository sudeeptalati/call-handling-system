<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $contract_id
 * @property integer $brand_id
 * @property integer $product_type_id
 * @property integer $customer_id
 * @property integer $engineer_id
 * @property string $purchased_from
 * @property string $purchase_date
 * @property string $warranty_date
 * @property string $model_number
 * @property string $serial_number
 * @property string $production_code
 * @property string $enr_number
 * @property string $fnr_number
 * @property integer $discontinued
 * @property integer $warranty_for_months
 * @property double $purchase_price
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property string $lockcode
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 * @property Engineer $engineer
 * @property Customer $customer
 * @property ProductType $productType
 * @property Brand $brand
 * @property Contract $contract
 * @property User $createdByUser
 * @property Servicecall[] $servicecalls
 */
class Product extends CActiveRecord
{
	
	public $created_by_user;
	public $contracter_name;
	public $brand_name;
	public $product_name;
	public $customer_name;
	public $engineer_name;
	public $warranty_until;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_id, brand_id, product_type_id', 'required'),
			array('contract_id, brand_id, product_type_id, customer_id, engineer_id, discontinued, warranty_for_months, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('purchase_price', 'numerical'),
			array('purchased_from, warranty_until, purchase_date, warranty_date, model_number, serial_number, production_code, enr_number, fnr_number, notes, modified, cancelled, lockcode', 'safe'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contract_id, brand_id, product_type_id, customer_id, engineer_id, purchased_from, purchase_date, warranty_date, model_number, serial_number, production_code, enr_number, fnr_number, discontinued, warranty_for_months, purchase_price, notes, created_by_user_id, created, modified, cancelled', 'safe', 'on'=>'search'),
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
			'customers' => array(self::HAS_MANY, 'Customer', 'product_id'),
			'engineer' => array(self::BELONGS_TO, 'Engineer', 'engineer_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contract_id' => 'Contract',
			'brand_id' => 'Brand',
			'product_type_id' => 'Product Type',
			'customer_id' => 'Customer',
			'engineer_id' => 'Engineer',
			'purchased_from' => 'Purchased From',
			'purchase_date' => 'Purchase Date',
			'warranty_date' => 'Warranty Date',
			'model_number' => 'Model Number',
			'serial_number' => 'Serial Number',
			'production_code' => 'Production Code',
			'enr_number' => 'Enr Number',
			'fnr_number' => 'Fnr Number',
			'discontinued' => 'Discontinued',
			'warranty_for_months' => 'Warranty For Months',
			'purchase_price' => 'Purchase Price',
			'notes' => 'Product Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'cancelled' => 'Cancelled',
		/*USER ADDED ATTRIBUTED*/
			'warranty_until' => 'Warranty Until',
		
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
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('engineer_id',$this->engineer_id);
		$criteria->compare('purchased_from',$this->purchased_from,true);
		$criteria->compare('purchase_date',$this->purchase_date,true);
		$criteria->compare('warranty_date',$this->warranty_date,true);
		$criteria->compare('model_number',$this->model_number,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('production_code',$this->production_code,true);
		$criteria->compare('enr_number',$this->enr_number,true);
		$criteria->compare('fnr_number',$this->fnr_number,true);
		$criteria->compare('discontinued',$this->discontinued);
		$criteria->compare('warranty_for_months',$this->warranty_for_months);
		$criteria->compare('purchase_price',$this->purchase_price);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('cancelled',$this->cancelled,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	public function getAllBrands()
    {
    	return CHtml::listData(Brand::model()->findAll(), 'id', 'name');
    }//end of getAllBrands().
    
    public function getProductTypes()
    {
    	return CHtml::listData(ProductType::model()->findAll(), 'id', 'name');
    }//end of getproductTypes().
    
    public function getAllContract()
    {
    	return CHtml::listData(Contract::model()->findAll(), 'id', 'name','contractType.name');
    }//end of getAllContract().
    
    public function getAllEngineers()
    {
    	return CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
    }//end of getAllEngineers().
    
    protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		$this->created=time();
        		$this->lockcode=Yii::app()->user->id*1000;
        		$this->customer_id=0;
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
    
    }//end of afterSave().
}//end of class.
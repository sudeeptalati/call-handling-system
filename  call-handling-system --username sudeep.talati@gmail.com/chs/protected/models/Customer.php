<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property integer $product_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $address_line_3
 * @property string $town
 * @property string $postcode_s
 * @property string $country
 * @property string $telephone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $fullname
 * @property string $lockcode
 * @property string $postcode_e
 * @property string $postcode
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property User $createdByUser
 * @property Product[] $products
 * @property Servicecall[] $servicecalls
 */
class Customer extends CActiveRecord
{
	public $created_by_user;
	public $product_type;
	public $product_brand;
	public $model_number;
	public $serial_number;
	public $service_number;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, first_name, last_name, address_line_1, town, postcode_s, postcode_e, telephone', 'required'),
			array('product_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('address_line_2, address_line_3, country, mobile, fax, notes, modified, fullname, lockcode', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, first_name, last_name, product_id, address_line_1, address_line_2, address_line_3, town, postcode, country, telephone, mobile, fax, email, notes, created_by_user_id, created, modified, fullname, postcode', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'products' => array(self::HAS_MANY, 'Product', 'customer_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'product_id' => 'Product',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => 'Address Line 2',
			'address_line_3' => 'Address Line 3',
			'town' => 'Town',
			'postcode_s' => 'Postcode',
			'postcode_e' => 'Postcode_e',
			'country' => 'Country',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'fax' => 'Fax',
			'email' => 'Email',
			'notes' => 'Customer Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'fullname' => 'Customer Name',
			'postcode' => 'Postcode',
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
		
		$criteria->with = array('servicecalls');
    	

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('address_line_1',$this->address_line_1,true);
		$criteria->compare('address_line_2',$this->address_line_2,true);
		$criteria->compare('address_line_3',$this->address_line_3,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode_s',$this->postcode_s,true);
		$criteria->compare('postcode_e',$this->postcode_e,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('fullname',$this->fullname,true);
		//$criteria->compare('servicecalls.service_reference_number',$this->service_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
        {
        	$trimmed_s = $this->postcode_s;
        	$trimmed_e = $this->postcode_e;
        	$this->fullname=$this->first_name." ".$this->last_name;
        	$this->postcode=$trimmed_s." ".$trimmed_e;
        	
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		
        		/******CHECKING WHETHER CUSTOMER IS CREATED FROM CREATE OF CUSTOMER*/
        		if($this->lockcode == '0')
        		{
        			//echo "Lockcode is set to zeero, In Create of customers";
        			$this->lockcode=0;
        		}
        		else 
        		{
        			//echo "Lockdode is not set, some error";
        			$this->lockcode=Yii::app()->user->id*1000;
        		}
        		
        		        		
        		$this->created=time();
        		
        		//SAVING DETAILS TO PRODUCT TABLE.
        		
        		$productModel=new Product;
        		$productModel->attributes=$_POST['Product'];
        		//$productModel->customer_id=0;
				if($productModel->save())
				{
					//echo "lockcode of product model is :".$productModel->lockcode."<br>";
				}
				
				//GETTING LOCKCODE FROM PRODUCT TABLE.
				
				$lockcode=$productModel->lockcode;
				
				$productQueryModel = Product::model()->findByAttributes(
        											array('lockcode'=>$lockcode)
													);
				//echo "ID GOT FROM LOCKCODE : ".$productQueryModel->id;
				
				$this->product_id=$productQueryModel->id;
        		
        		return true;
            }//end of if($this->isNewRecord).
            /******** END OF SAVING NEW RECORD *************/
            else
            {
            	if(isset($_GET['product_id']))
//            		$prod_id=$_GET['product_id'];
//            		
//            	if($prod_id != $this->product_id)
            	{
            		//echo "SECONDARY PROD";
            		$product_id=$_GET['product_id'];/* CHECKING FOR PRIMARY PRODUCT */
            		//echo $product_id;
            		
            		$productModel=Product::model()->findByPk($product_id);
	            	$productModel->attributes=$_POST['Product'];
	            	if($productModel->save())
	            	{
	            		
	            	}
					$this->modified=time();
	                return true;
            	}//end of if(isset()).
            	
            	else 
            	{
            	//	echo "PRIMARY PROD";
            		
	            	$productModel=Product::model()->findByPk($this->product_id);
		            $productModel->attributes=$_POST['Product'];
		            if($productModel->save())
		            {
		            	
		            }
					$this->modified=time();
		            return true;
            	}//end of else of if(isset()).
            	//}//end of if().
          	}//end of ELSE of if($this->isNewRecord).
        }//end of if(parent())
	}//end of beforeSave().
	
	protected function afterSave()
    {
    	$productQueryModel = Product::model()->findByPK(
        											$this->product_id
													);
    	//echo "PRODUCT ID IN AFTER SAVE() :".$productQueryModel->id;
    	
    	$productUpdateModel = Product::model()->updateByPk(
													$productQueryModel->id,
													
													array
													(
														'lockcode'=>0,
														'customer_id'=>$this->id
													)
													);
    	
    }//END OF afterSave().
    
    public function freeSearch($keyword)
    {   
    	$criteria=new CDbCriteria;
    	
    	//$criteria->with = array('servicecalls');
    	
    	$criteria->compare('fullname', $keyword, true, 'OR');
 
    	$criteria->compare('postcode', $keyword, true, 'OR');
    	$criteria->compare('town', $keyword, true, 'OR');
    	$criteria->compare('telephone', $keyword, true, 'OR');
    	$criteria->compare('mobile', $keyword, true, 'OR');
    	
    	
    	/*result limit*/
        $criteria->limit = 100;
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        	));
    	
    }//end of freeSearch().
    
    public function getAllProducts($id)
    {
    	return Product::model()->findAllByAttributes(array('customer_id'=>$id));
    }
    
    
}//end of class.
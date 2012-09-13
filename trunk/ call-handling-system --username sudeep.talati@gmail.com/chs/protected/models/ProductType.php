<?php

/**
 * This is the model class for table "product_type".
 *
 * The followings are the available columns in table 'product_type':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $server_product_type_id
 *
 * The followings are the available model relations:
 * @property Product[] $products
 * @property User $createdByUser
 */
class ProductType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductType the static model class
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
		return 'product_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('information, modified','server_product_type_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, created_by_user_id, created, modified, server_product_type_id', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Product', 'product_type_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Product Type',
			'information' => 'Information',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'server_product_type_id' => 'Server Product Type Id',
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
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('server_product_type_id',$this->server_product_type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
}
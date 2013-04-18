<?php

/**
 * This is the model class for table "brand".
 *
 * The followings are the available columns in table 'brand':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $active
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $inactivated
 *
 * The followings are the available model relations:
 * @property User $createdByUser
 * @property Product[] $products
 */
class Brand extends CActiveRecord
{
	
	public $created_by_user;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Brand the static model class
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
		return 'brand';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, active', 'required'),
			array('active, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('information, modified, inactivated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, active, created_by_user_id, created, modified, inactivated', 'safe', 'on'=>'search'),
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
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'products' => array(self::HAS_MANY, 'Product', 'brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Brand Name',
			'information' => 'Information',
			'active' => 'Active',
			//'created_by_user_id' => 'Created By User',
			//'created' => 'Created',
			'modified' => 'Modified',
			'inactivated' => 'Inactivated',
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
		$criteria->compare('active',$this->active);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('inactivated',$this->inactivated,true);
		$criteria->order = 'created ASC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			
		));
	}//end of search.
	
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
            	$this->created_by_user_id=Yii::app()->user->id;
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
}//END OF CLASS
<?php

/**
 * This is the model class for table "contract_type".
 *
 * The followings are the available columns in table 'contract_type':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $created_by_user_id
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Contract[] $contracts
 * @property User $createdByUser
 */
class ContractType extends CActiveRecord
{
	
	public $created_by_user;
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContractType the static model class
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
		return 'contract_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_by_user_id, created', 'required'),
			array('created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('information', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, created_by_user_id, created', 'safe', 'on'=>'search'),
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
			'contracts' => array(self::HAS_MANY, 'Contract', 'contract_type_id'),
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
			'name' => 'Name',
			'information' => 'Information',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		$this->created=date("F j, Y, g:i a");
    			return true;
            }
            else
            {
            	return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
}
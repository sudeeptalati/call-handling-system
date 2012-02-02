<?php

/**
 * This is the model class for table "contract".
 *
 * The followings are the available columns in table 'contract':
 * @property integer $id
 * @property integer $contract_type_id
 * @property string $name
 * @property integer $main_contact_details_id
 * @property integer $management_contact_details_id
 * @property integer $spares_contact_details_id
 * @property integer $accounts_contact_details_id
 * @property integer $technical_contact_details_id
 * @property string $vat_reg_number
 * @property string $notes
 * @property integer $active
 * @property integer $inactivated_by_user_id
 * @property string $inactivated_on
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property User $inactivatedByUser
 * @property User $createdByUser
 * @property ContactDetails $technicalContactDetails
 * @property ContactDetails $accountsContactDetails
 * @property ContactDetails $sparesContactDetails
 * @property ContactDetails $managementContactDetails
 * @property ContactDetails $mainContactDetails
 * @property ContractType $contractType
 * @property Product[] $products
 * @property Servicecall[] $servicecalls
 */
class Contract extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contract the static model class
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
		return 'contract';
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
			array('contract_type_id, main_contact_details_id, management_contact_details_id, spares_contact_details_id, accounts_contact_details_id, technical_contact_details_id, active, inactivated_by_user_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('vat_reg_number, notes, inactivated_on, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contract_type_id, name, main_contact_details_id, management_contact_details_id, spares_contact_details_id, accounts_contact_details_id, technical_contact_details_id, vat_reg_number, notes, active, inactivated_by_user_id, inactivated_on, created_by_user_id, created, modified', 'safe', 'on'=>'search'),
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
			'inactivatedByUser' => array(self::BELONGS_TO, 'User', 'inactivated_by_user_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'technicalContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'technical_contact_details_id'),
			'accountsContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'accounts_contact_details_id'),
			'sparesContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'spares_contact_details_id'),
			'managementContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'management_contact_details_id'),
			'mainContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'main_contact_details_id'),
			'contractType' => array(self::BELONGS_TO, 'ContractType', 'contract_type_id'),
			'products' => array(self::HAS_MANY, 'Product', 'contract_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'contract_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contract_type_id' => 'Contract Type',
			'name' => 'Name',
			'main_contact_details_id' => 'Main Contact Details',
			'management_contact_details_id' => 'Management Contact Details',
			'spares_contact_details_id' => 'Spares Contact Details',
			'accounts_contact_details_id' => 'Accounts Contact Details',
			'technical_contact_details_id' => 'Technical Contact Details',
			'vat_reg_number' => 'Vat Reg Number',
			'notes' => 'Notes',
			'active' => 'Active',
			'inactivated_by_user_id' => 'Inactivated By User',
			'inactivated_on' => 'Inactivated On',
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
		$criteria->compare('contract_type_id',$this->contract_type_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('main_contact_details_id',$this->main_contact_details_id);
		$criteria->compare('management_contact_details_id',$this->management_contact_details_id);
		$criteria->compare('spares_contact_details_id',$this->spares_contact_details_id);
		$criteria->compare('accounts_contact_details_id',$this->accounts_contact_details_id);
		$criteria->compare('technical_contact_details_id',$this->technical_contact_details_id);
		$criteria->compare('vat_reg_number',$this->vat_reg_number,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('inactivated_by_user_id',$this->inactivated_by_user_id);
		$criteria->compare('inactivated_on',$this->inactivated_on,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

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
        		$this->created=date("F j, Y, g:i a");
        		
        		
        		//SAVING CONTACT DETAILS TABLE.
        		
        		$contactDetailsModel = new ContactDetails;
                $contactDetailsModel->attributes = $_POST['ContactDetails'];
        		if($contactDetailsModel->save())
        		{
        			//echo "lockcode is :".$contactDetailsModel->lockcode."<br>";
        		}
        		
        		//GETTING THE VALUE OF LOCKCODE.
        		
        		$lockcode=$contactDetailsModel->lockcode;
        		
        		$contactDetailsQueryModel = ContactDetails::model()->findByAttributes(
        											array('lockcode'=>$lockcode)
													);
				//echo "ID GOT FROM LOCKCODE : ".$contactDetailsQueryModel->id;		

				$this->main_contact_details_id=$contactDetailsQueryModel->id;
				
        		
        		//$this->main_contact_details_id=
        		
        		//$this->main_contact_details_id=1;
        		
        		//TO GET LOCK.
        		
//        		$contactDetailsQueryModel = ContactDetails::model()->findByAttributes(
//													'lockcode'
//														);
				//echo "lockcode = ".$contactDetailsQueryModel->lockcode;
														
    			return true;
            }
            else
            {
            	$this->modified=date("F j, Y, g:i a");
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    
    protected function afterSave()
    {
    	
    	$contactDetailsQueryModel = ContactDetails::model()->findByPK(
        											$this->main_contact_details_id
													);
    	//echo "ID IN AFTER SAVE() :".$contactDetailsQueryModel->id;
    	
    	$contactDetailsUpdateModel = ContactDetails::model()->updateByPk(
													$contactDetailsQueryModel->id,
													
													array
													(
														'lockcode'=>0
													)
													);
    	
    }
    
    public function getContractType()
    {
    	return CHtml::listData(ContractType::model()->findAll(), 'id', 'name');
    }//end of getContractType().
    
    
}//end of class.
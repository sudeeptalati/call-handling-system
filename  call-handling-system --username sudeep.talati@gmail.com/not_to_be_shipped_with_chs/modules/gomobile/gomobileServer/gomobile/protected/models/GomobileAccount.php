<?php

/**
 * This is the model class for table "gomobile_account".
 *
 * The followings are the available columns in table 'gomobile_account':
 * @property integer $id
 * @property string $gomobile_account_name
 * @property string $company_name
 * @property string $contact_email
 * @property integer $no_of_rapport_users
 * @property integer $no_of_engineers
 * @property string $created_on
 * @property string $last_modified_on
 */
class GomobileAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gomobile_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_of_rapport_users, no_of_engineers', 'numerical', 'integerOnly'=>true),
			array('gomobile_account_name, company_name, contact_email, created_on, last_modified_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gomobile_account_name, company_name, contact_email, no_of_rapport_users, no_of_engineers, created_on, last_modified_on', 'safe', 'on'=>'search'),
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
			'gomobile_account_name' => 'Gomobile Account Name',
			'company_name' => 'Company Name',
			'contact_email' => 'Contact Email',
			'no_of_rapport_users' => 'No Of Rapport Users',
			'no_of_engineers' => 'No Of Engineers',
			'created_on' => 'Created On',
			'last_modified_on' => 'Last Modified On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('gomobile_account_name',$this->gomobile_account_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('no_of_rapport_users',$this->no_of_rapport_users);
		$criteria->compare('no_of_engineers',$this->no_of_engineers);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('last_modified_on',$this->last_modified_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GomobileAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
    		if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_on=time();
				
    			return true;
            }
            else
            {
                $this->last_modified_on=time();
                return true;
            }
        }//end of if(parent())
        else
        	return false;
    }//end of beforeSave()  
}

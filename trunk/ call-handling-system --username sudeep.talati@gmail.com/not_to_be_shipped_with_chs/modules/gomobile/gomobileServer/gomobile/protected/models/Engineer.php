<?php

/**
 * This is the model class for table "engineer".
 *
 * The followings are the available columns in table 'engineer':
 * @property integer $id
 * @property string $engineer_email
 * @property string $pwd
 * @property string $exp_date
 * @property string $created
 * @property string $last_modified
 */
class Engineer extends CActiveRecord
{
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
			array('engineer_email', 'email'),	
			array('engineer_email', 'unique'),
			array('engineer_email, pwd, exp_date', 'required'),
			array('engineer_email, pwd, exp_date, created, last_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, engineer_email, pwd, exp_date, created, last_modified', 'safe', 'on'=>'search'),
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
			'engineer_email' => 'Engineer Email',
			'pwd' => 'Pwd',
			'exp_date' => 'Exp Date',
			'created' => 'Created',
			'last_modified' => 'Last Modified',
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
		$criteria->compare('engineer_email',$this->engineer_email,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('exp_date',$this->exp_date,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_modified',$this->last_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Engineer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	
	
	
	public function validatePassword($pwd)	
    {
    	if (!empty($this->newPwd))
    	
                    $this->pwd = hash('sha256', $this->newPwd);
    }//end of validatePassword().
    
    protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
       		$this->pwd = hash('sha256', $this->pwd);
			$this->exp_date=strtotime($this->exp_date);

			if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
				
    			return true;
            }
            else
            {
                $this->modified=time();
                return true;
            }
        }//end of if(parent())
        else
        	return false;
    }//end of beforeSave()          
	
}

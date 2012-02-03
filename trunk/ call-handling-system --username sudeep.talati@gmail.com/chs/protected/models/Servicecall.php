<?php

/**
 * This is the model class for table "servicecall".
 *
 * The followings are the available columns in table 'servicecall':
 * @property integer $id
 * @property integer $service_reference_number
 * @property integer $customer_id
 * @property integer $product_id
 * @property integer $contract_id
 * @property integer $engineer_id
 * @property string $insurer_reference_number
 * @property integer $job_status_id
 * @property string $fault_date
 * @property string $fault_code
 * @property string $fault_description
 * @property string $engg_visit_date
 * @property string $work_carried_out
 * @property integer $spares_used_status_id
 * @property double $total_cost
 * @property double $vat_on_total
 * @property double $net_cost
 * @property string $job_payment_date
 * @property string $job_finished_date
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property string $closed
 *
 * The followings are the available model relations:
 * @property SparesUsedStatus $sparesUsedStatus
 * @property JobStatus $jobStatus
 * @property Engineer $engineer
 * @property Contract $contract
 * @property Product $product
 * @property Customer $customer
 * @property User $createdByUser
 */
class Servicecall extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Servicecall the static model class
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
		return 'servicecall';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_reference_number, customer_id, product_id, contract_id, job_status_id, fault_description, created_by_user_id, created', 'required'),
			array('service_reference_number, customer_id, product_id, contract_id, engineer_id, job_status_id, spares_used_status_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('total_cost, vat_on_total, net_cost', 'numerical'),
			array('insurer_reference_number, fault_date, fault_code, engg_visit_date, work_carried_out, job_payment_date, job_finished_date, notes, modified, cancelled, closed', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service_reference_number, customer_id, product_id, contract_id, engineer_id, insurer_reference_number, job_status_id, fault_date, fault_code, fault_description, engg_visit_date, work_carried_out, spares_used_status_id, total_cost, vat_on_total, net_cost, job_payment_date, job_finished_date, notes, created_by_user_id, created, modified, cancelled, closed', 'safe', 'on'=>'search'),
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
			'sparesUsedStatus' => array(self::BELONGS_TO, 'SparesUsedStatus', 'spares_used_status_id'),
			'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'job_status_id'),
			'engineer' => array(self::BELONGS_TO, 'Engineer', 'engineer_id'),
			'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
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
			'service_reference_number' => 'Service Reference Number',
			'customer_id' => 'Customer',
			'product_id' => 'Product',
			'contract_id' => 'Contract',
			'engineer_id' => 'Engineer',
			'insurer_reference_number' => 'Insurer Reference Number',
			'job_status_id' => 'Job Status',
			'fault_date' => 'Fault Date',
			'fault_code' => 'Fault Code',
			'fault_description' => 'Fault Description',
			'engg_visit_date' => 'Engg Visit Date',
			'work_carried_out' => 'Work Carried Out',
			'spares_used_status_id' => 'Spares Used Status',
			'total_cost' => 'Total Cost',
			'vat_on_total' => 'Vat On Total',
			'net_cost' => 'Net Cost',
			'job_payment_date' => 'Job Payment Date',
			'job_finished_date' => 'Job Finished Date',
			'notes' => 'Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'cancelled' => 'Cancelled',
			'closed' => 'Closed',
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
		$criteria->compare('service_reference_number',$this->service_reference_number);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('engineer_id',$this->engineer_id);
		$criteria->compare('insurer_reference_number',$this->insurer_reference_number,true);
		$criteria->compare('job_status_id',$this->job_status_id);
		$criteria->compare('fault_date',$this->fault_date,true);
		$criteria->compare('fault_code',$this->fault_code,true);
		$criteria->compare('fault_description',$this->fault_description,true);
		$criteria->compare('engg_visit_date',$this->engg_visit_date,true);
		$criteria->compare('work_carried_out',$this->work_carried_out,true);
		$criteria->compare('spares_used_status_id',$this->spares_used_status_id);
		$criteria->compare('total_cost',$this->total_cost);
		$criteria->compare('vat_on_total',$this->vat_on_total);
		$criteria->compare('net_cost',$this->net_cost);
		$criteria->compare('job_payment_date',$this->job_payment_date,true);
		$criteria->compare('job_finished_date',$this->job_finished_date,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('cancelled',$this->cancelled,true);
		$criteria->compare('closed',$this->closed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
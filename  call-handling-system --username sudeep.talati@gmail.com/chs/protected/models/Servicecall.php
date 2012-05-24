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
 * @property string $engg_diary_id
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
 * @property integer $recalled_job
 * @property string $activity_log
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
	public $user_name;
	public $customer_name;
	public $customer_town;
	public $customer_postcode;
	public $product_name;
	public $engineer_name;
	public $contract_name;
	public $job_status;
	
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
			array('job_status_id, fault_description, recalled_job', 'required'),
			array('created_by_user_id,	service_reference_number, customer_id, product_id, contract_id, engineer_id, job_status_id, spares_used_status_id', 'numerical', 'integerOnly'=>true),
			array('total_cost, vat_on_total, net_cost', 'numerical'),
			array('number_of_visits, customer_town,customer_postcode , recalled_job, activity_log , insurer_reference_number, fault_date, fault_code, engg_diary_id, work_carried_out, job_payment_date, job_finished_date, notes, modified, cancelled, closed, ', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('created_by_user_id,id, customer_town , customer_postcode, customer_name, customer_id, job_status, engineer_name, product_name, service_reference_number, insurer_reference_number, job_status_id, fault_date, fault_code, fault_description, engg_visit_date, work_carried_out, spares_used_status_id, total_cost, vat_on_total, net_cost, job_payment_date, job_finished_date, notes,  created, modified, cancelled, closed', 'safe', 'on'=>'search'),
			
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
			'enggdiary' => array(self::BELONGS_TO, 'Enggdiary', 'engg_diary_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'service_reference_number' => 'Job Ref. No#',
			'customer_id' => 'Customer',
			'product_id' => 'Product',
			'contract_id' => 'Contract',
			'engineer_id' => 'Engineer',
			'insurer_reference_number' => ' Reference No#',
			'job_status_id' => 'Job Status',
			'fault_date' => 'Reported Date',
			'fault_code' => 'Fault Code',
			'fault_description' => 'Issue Reported',
			'engg_diary_id' => 'Engineer Diary',
			'work_carried_out' => 'Work Carried Out',
			'spares_used_status_id' => 'Spares Used ',
			'total_cost' => 'Total Cost',
			'vat_on_total' => 'Vat On Total',
			'net_cost' => 'Net Cost',
			'job_payment_date' => 'Job Payment Date',
			'job_finished_date' => 'Job Finished Date',
			'notes' => 'Call Requirement / Instruction Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'cancelled' => 'Cancelled',
			'closed' => 'Closed',
		'customer_town' => 'Town',
		'customer_postcode' => 'Postcode',	
		
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
		
		$criteria->order = 'service_reference_number DESC';
		
		$criteria->with = array( 'customer','jobStatus','engineer');
		//$criteria->together= true;
		
		$criteria->compare( 'customer.fullname', $this->customer_name, true );
		$criteria->compare( 'customer.town', $this->customer_town, true );
		$criteria->compare( 'customer.postcode', $this->customer_postcode, true );
		
		$criteria->compare( 'jobStatus.name', $this->job_status, true );
		$criteria->compare( 'engineer.fullname', $this->engineer_name, true );
		
		
		$criteria->compare('id',$this->id);
		$criteria->compare('service_reference_number',$this->service_reference_number);
		 
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('engineer_id',$this->engineer_id);
		$criteria->compare('insurer_reference_number',$this->insurer_reference_number,true);
		$criteria->compare('job_status_id',$this->job_status_id);
		$criteria->compare('fault_date',$this->fault_date,true);
		$criteria->compare('fault_code',$this->fault_code,true);
		$criteria->compare('fault_description',$this->fault_description,true);
		$criteria->compare('engg_diary_id',$this->engg_diary_id,true);
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
		$criteria->compare('recalled_job',$this->recalled_job);
		$criteria->compare('activity_log',$this->activity_log);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
 
		
	}//end of search().
	
	protected function beforeSave()
    {
    	
        	
    	if(parent::beforeSave())
        {
        	
        	$this->net_cost=$this->total_cost+$this->vat_on_total;
        	$this->job_payment_date=strtotime($this->job_payment_date);
        	$this->job_finished_date=strtotime($this->job_finished_date);
        	$this->fault_date=strtotime($this->fault_date);
        		 
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		$this->created=time();
        		//$user=Yii::app()->user->id
        		$this->activity_log="Service status is changed to booked by ".$this->createdByUser->username." on ".date('d-M-Y', time()).".\n";
        		
        		
        		//SETTING SERVICE REFERENCE NUMBER.
        		$count_sql = "SELECT COUNT(*) FROM servicecall";
				$total_records = Yii::app()->db->createCommand($count_sql)->queryScalar();
				if ($total_records==0)
				{
					$this->service_reference_number=200001;					
				}//end of if
				else 
				{
					$last_po_number = Yii::app()->db->createCommand()
                                ->select('id , service_reference_number')                                
                                ->from('servicecall')
                                ->order('id DESC')
                                ->limit(1,0)
                                ;
                	$data = $last_po_number->query();				
					foreach ($data as $out)
					{
						$serviceRefNo=$out['service_reference_number'];
						$this->service_reference_number=$serviceRefNo+1;
					}///end of foreach
				}//end of else.
				
				/******* END OF SETTING service_reference_number ********/
				
        		//GETTING CUSTOMER ID FROM URL.
				if (isset($_GET['customer_id']))
				{
					$cust_id=$_GET['customer_id'];
					//echo "CUSTOMER ID FROM URL :".$cust_id;
				}
				elseif (isset($_GET['cust_id']))
				{
					//echo $_GET['cust_id'];
					//$cust_id = $_GET['cust_id'];
					$this->customer_id = $_GET['cust_id'];
				}

				
				if($this->customer_id=='0')//customer_id=0 INDICATES NEW CUSTOMER.
				{
					//SAVING NEW CUSTOMER DATA TO CUSTOMER TABLE.
					$customerModel=new Customer;
	        		$customerModel->attributes=$_POST['Customer'];
	        		if($customerModel->save())
	        		{
	        			//echo "lockcode of customer id : ".$customerModel->lockcode."<br>";
	        		}
	        		
	        		$lockcode=$customerModel->lockcode;
	        		
	        		$customerQueryModel=Customer::model()->findByAttributes(
	        									array('lockcode'=>$lockcode)
	        									);
	        									
					$productModel=Product::model()->findByAttributes(
	        									array('lockcode'=>$lockcode)
	        									);      									
	        									
					//echo "ID FROM LOCKCODE IN CUSTOMER IS : ".$customerQueryModel->id."<br>";
					//echo "PRODUCT ID FROM CUSTOMER TABLE IS : ".$customerQueryModel->product_id;
	
					$this->customer_id=$customerQueryModel->id;
					$this->product_id=$customerQueryModel->product_id;
					
					//SETTING contract_id OF SERVICECALL, BY GETTING VALUE FROM PRODUCT TABLE.
					
					$productId=$customerQueryModel->product_id;
					
					$productModel=Product::model()->findByAttributes(
        									array('id'=>$productId)
        									);      						
        			//echo "CONTRACT ID FROM PRODUCT TABLE : ".$productModel->contract_id;									
        			$this->contract_id=$productModel->contract_id;
					$this->engineer_id=$productModel->engineer_id;
				}//end of if($this->customer_id=='0').
				
				/********* END OF SAVING NEW CUSTOMER DETAILS*********/
				
				/********* SAVING EXISTING CUSTOMER DETAILS*********/
				
				else 
				{
					if(isset($_GET['product_id']))/***** THIS BIT IS CALLED WHILE RAISING CALL FOR SECONDARY PROD FROM DASHBOARD.*/
					{
						//echo "product id in model :".$_GET['product_id'];
						//echo "customer id in model :".$_GET['customer_id'];
						$this->customer_id=$cust_id;
						$this->product_id = $_GET['product_id'];
					}
					elseif (isset($_GET['cust_id']))/* THIS BIT ID CALLED WHEN ADDING PRODUCT AND CREATING CALL */
					{
						$this->customer_id = $_GET['cust_id'];
					}
					else /* THIS BIT ID CALLED WHEN CREATING SERVICECALL WITH PRIMARY PROD.*/
					{
						//EXISTING CUSTOMER.
						//echo $_GET['cust_id'];
						$this->customer_id=$cust_id;
						$customerQueryModel=Customer::model()->findByPk($cust_id);
						$this->product_id=$customerQueryModel->product_id;
						/* WORKING FINE TILL NOW DOT CHANGE HERE */
					}
				}//END OF ELSE OF EXISTING CUST.
				
				/****** END OF SAVING EXISTING CUSTOMERS DETAILS *****/
				
				return true;
				
            }//end of if(newrecord).
            /****** END OF IF OF NEW RECORD ************/
            
            /********* THIS BIT IS CALLED DURING UPDATE *********/
            else
            {     	
            	$current_user=Yii::app()->user->name;
            	$this->activity_log.="\n Status is changed to ".$this->jobStatus->name." by ".$current_user;
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    
    protected function afterSave()
    {
    	$customerQueryModel = Customer::model()->findByPK($this->customer_id);
													
    	$customerUpdateModel = Customer::model()->updateByPk(
													$customerQueryModel->id,
													array
													(
														'lockcode'=>0,
													)
													);
													
		$productQueryModel = Product::model()->findByPk($this->product_id);
		
		$productUpdateModel = Product::model()->updateByPk($productQueryModel->id,
												array(
												'contract_id'=>$this->contract_id,
												
												)
												);
															
    	
    }//END OF afterSave().
    
    public function getAllContract()
    {
    	return CHtml::listData(Contract::model()->findAll(), 'id', 'name', 'contractType.name');
    }//end of getAllContract().
    
    public function getAllEngineers()
    {
    	return CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
    }//end of getAllEngineers().
    
    public function getJobStatus($status_code)
    {
    	switch ($staus_code)
		{
			case 1: $str="Draft"; break;
			case 2: $str="Send"; break;
			case 3: $str="Rejected"; break;
			case 4: $str="Partially received"; break;
			case 5: $str="Received"; break;
			case 6: $str="Pick Up"; break;
			case 11: $str="Cancelled"; break;
			case 12: $str="Deleted"; 
			//default: break;
		}
			
		return $str;
    }//end of getJobStatus.
    
	public function freeSearch($keyword)
    {   
 
        /*Creating a new criteria for search*/
        $criteria = new CDbCriteria;
        
        $criteria->with = array('customer');
        
        $criteria->compare('insurer_reference_number',$keyword,true);
        $criteria->compare('service_reference_number', $keyword, true, 'OR');
        $criteria->compare('customer.fullname', $keyword, true, 'OR');
        $criteria->compare('customer.postcode', $keyword, true, 'OR');
        $criteria->compare('customer.mobile', $keyword, true, 'OR');
        $criteria->compare('customer.telephone', $keyword, true, 'OR');
        
//        $criteria->with=array('customer');
//        $criteria->compare('customer.fullname', $keyword, true, 'OR');
       
        /*result limit*/
        $criteria->limit = 100;
        /*When we want to return model*/
        //return  Servicecall::model()->findAll($criteria);
 
        /*To return active dataprovider uncomment the following code*/
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        
 
    }//end of free search.
    

    public function getStatus()
    {
    	return CHtml::listData(JobStatus::model()->findAll(), 'id', 'name');
    }//end of getStatus().
    
    
    public function updateStatus()
    {
//    	$result = JobStatus::model()->findAllByAttributes(array(), 
//    														'id>:t1 AND published=:t2', 
//    														array(':t1'=>2,':t2'=>1), 
//    														array('order'=>'view_order')
//    													);

    	$result=JobStatus::model()->findAll(
											array(
												'condition'=>'published=1',
												'order'=>'view_order ASC',
												)
				    						);
    	return $result;
    }//end of updateStatus().
    
    public function previousCall($customer_id,$product_id)
    {
    	?>
    	
    	<table><tr>
    	<th>Service Reference Number</th>
    	<th>Reported Date</th>
    	<th>Fault Description</th>
    	<th>Engineer Visited</th>
    	<th>Visit Date</th>
    	<th>Job Status</th>
    	</tr>
    	<?php 
    	$result = Servicecall::model()->findAllByAttributes(array('customer_id'=>$customer_id, 'product_id'=>$product_id));
    	
    	foreach ($result as $data)
    	{
    		$enggdiaryModel=Enggdiary::model()->findByPk($data->engg_diary_id);
    	?>
    		<tr>
    		<td><?php echo CHtml::link($data->service_reference_number, array('view', 'id'=>$data->id));?></td>
    		<td><?php
    				if(!empty($data->fault_date)) 
    					echo date('d-M-Y', $data->fault_date);
    			?>
    		</td>
    		<td><?php echo $data->fault_description;?></td>
    		<td><?php echo $data->engineer->fullname;?></td>
    		<td><?php
    				if(!empty($enggdiaryModel->visit_start_date)) 
    					echo date('d-M-Y',$enggdiaryModel->visit_start_date);?>
    		</td>
    		<td style="color:maroon"><?php echo $data->jobStatus->name;?></td>
    		</tr>
    	
    	<?php }?>
    	</table>
    	<?php 
    	
    	
    }//end of previousCall().
    
}//end of class.
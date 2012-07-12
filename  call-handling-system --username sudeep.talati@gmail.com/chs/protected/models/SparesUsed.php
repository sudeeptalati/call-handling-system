<?php

/**
 * This is the model class for table "spares_used".
 *
 * The followings are the available columns in table 'spares_used':
 * @property integer $id
 * @property integer $master_item_id
 * @property integer $servicecall_id
 * @property string $item_name
 * @property integer $part_number
 * @property double $unit_price
 * @property integer $quantity
 * @property double $total_price
 * @property string $date_ordered
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Servicecall $servicecall
 * @property MasterItems $masterItem
 */
class SparesUsed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SparesUsed the static model class
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
		return 'spares_used';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('master_item_id, servicecall_id, item_name, quantity', 'required'),
			array('master_item_id, servicecall_id, part_number, quantity', 'numerical', 'integerOnly'=>true),
			array('unit_price, total_price', 'numerical'),
			array('date_ordered, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, master_item_id, servicecall_id, item_name, part_number, unit_price, quantity, total_price, date_ordered, created, modified', 'safe', 'on'=>'search'),
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
			'servicecall' => array(self::BELONGS_TO, 'Servicecall', 'servicecall_id'),
			'masterItem' => array(self::BELONGS_TO, 'MasterItems', 'master_item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'master_item_id' => 'Master Item',
			'servicecall_id' => 'Servicecall',
			'item_name' => 'Item Name',
			'part_number' => 'Part Number',
			'unit_price' => 'Unit Price',
			'quantity' => 'Quantity',
			'total_price' => 'Total Price',
			'date_ordered' => 'Date Ordered',
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
		$criteria->compare('master_item_id',$this->master_item_id);
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('part_number',$this->part_number);
		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('date_ordered',$this->date_ordered,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

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
            	$this->total_price = $this->unit_price*$this->quantity;
        		$this->created_by_user=Yii::app()->user->id;
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->modified=time();
                return true;
            }
        }
    }//end of beforeSave().
    
    public function initialize()
    {
    	echo "<hr>Initialize is called";
    	
    	//$filename = '../jsonTest.json';
    	$filename = '../jsondata.json';
		$fh = fopen($filename, 'w');
		$beginStr = '{ "results": [';
		fwrite($fh, $beginStr);
		fclose($fh);
    	
    }//end of initialize.
    
    public function addData($param)
    {
    	echo "<hr>AddData is called, Adding data to file";
    	
    	$filename = '../jsondata.json';
//    	$filename = '../test.php';
//		$fh = fopen($filename, 'r');
//		$sData = fread($fh, filesize($filename));
//		echo "<hr>".$sData;
//		fclose($fh);
//		  
		$fh1 = fopen($filename, 'a');
		$str = ',';
		fwrite($fh1, json_encode($param));
		fwrite($fh1, $str);
		fclose($fh1);
		
		
    }//end of addData.

    
    public function finalize()
    {
    	echo "<hr> Finalize is called";
    	$finalStr = ']}';
		
		$filename = '../jsondata.json';
		
		$fh = fopen($filename, 'r+');
		$stat = fstat($fh);
		$trunkdata = ftruncate($fh, $stat['size']-1);
		//echo "<hr>".$trunkdata;
		fclose($fh); 
		
		$fh = fopen($filename, 'a');
		fwrite($fh, $finalStr);
		fclose($fh);
    	
    	$oldname = '../jsondata.json';
    	echo "<hr> path ".$oldname;
    	$newname = '../jsondataold.json';
    	
    	if(file_exists($oldname))
    	{
    		echo "<hr>php file is present";
    		rename($oldname, $newname);
    		echo "<hr> file is renamed";

    		$sparesModel = SparesUsed::model()->initialize();
    		echo "<hr> new file is created by initialize method";
    		
    	}
    	else
    	{
    		echo "<hr>file not present";
    	}	
    		
    }//end of finalize.
    

}//end of class.
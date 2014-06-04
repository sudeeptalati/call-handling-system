<?php

/**
 * This is the model class for table "addons".
 *
 * The followings are the available columns in table 'addons':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $addon_label 
 
 * @property string $information
 * @property integer $active
 * @property string $created_on
 * @property integer $created_by
 * @property string $inactivated_on
 * @property integer $inactivated_by
 */
class Addons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Addons the static model class
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
		return 'addons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, created_by, inactivated_by', 'numerical', 'integerOnly'=>true),
			array('type, name, addon_label ,information, created_on, inactivated_on', 'safe'),
			array('name', 'unique','message'=>'{attribute}:{value} 	already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name,addon_label , information, active, created_on, created_by, inactivated_on, inactivated_by', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'name' => 'Addon Name',
			'addon_label' => 'Addon Label',
			'information' => 'Information',
			'active' => 'Active',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'inactivated_on' => 'Inactivated On',
			'inactivated_by' => 'Inactivated By',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('addon_label',$this->addon_label,true);
		
		$criteria->compare('information',$this->information,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('inactivated_on',$this->inactivated_on,true);
		$criteria->compare('inactivated_by',$this->inactivated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function upload()
	{
		
		if(isset($_POST['finish']))/////if form Submitted
	    {
			if(isset($_POST['addon_url']))
			{
				/////Logic To Install from URL			
			}
			else
			{
				echo "Problems in Installing from URL";

			}
			
			
			$zip_mimes = array('application/zip', 'application/x-zip', 'application/octet-stream', 'application/x-zip-compressed');
			if (in_array($_FILES["addon_zip"]["type"], $zip_mimes))
			{
				//echo " I MA IN ";
			
				//echo "Uploaded Zip ";
				echo "<br>File naame is ".$_FILES["addon_zip"]["tmp_name"];
				$uploadedname="tempaddonfile.zip";
	    		$uploaded_file= $_FILES["addon_zip"]["tmp_name"];
				$location="temp/".$uploadedname;
				if (move_uploaded_file($uploaded_file,$location))
	    			{
	    				echo "<br>Temp zip Uploaded<br>";
						 
	    			}
	    			else
	    			{
	    				echo "Problem in storing";
	    			}
			}
			else
			{
				echo "Problems in Installing ZIP file";

			}
			
			
			
		}////end of if form submitted
					
	}//end of upload
	
	public function unzip()
	{
		//echo "File unzipped*";
		$zip = new ZipArchive;
		$res = $zip->open('temp/tempaddonfile.zip');
		if ($res === TRUE)
		{
		$zip->extractTo('temp/');
		echo "File unzipped<br>";
		$zip->close();
		}
		
	}//end of unzip
	
	public function readscript()
	{
		$db = new PDO('sqlite:protected/data/chs.db');
		$file_handle = fopen("temp/out of warranty module/sql.txt","r");
		$i=0;
		while (!feof($file_handle) ) 
							{
							
							$line_of_text = fgets($file_handle);
							if(!empty($line_of_text)){
							
							$db->exec($line_of_text);
							echo "db changed";
							}
							}
		$i++;
		fclose($file_handle);
	}
	
	
	public function copyfiles()
	{	
		echo "----------------";
		
		$xml=simplexml_load_file("temp/out of warranty module/sample_addon.xml");
		$source_file=getcwd()."/temp/".$xml->install->source->folder;

		
		$desti_file=getcwd()."/".$xml->install->destination->folder;
		
		echo $source_file;
		echo $desti_file;


		Setup::model()->recurse_copy($source_file,$desti_file);
		
	}
}
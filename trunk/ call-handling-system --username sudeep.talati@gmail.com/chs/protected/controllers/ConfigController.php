<?php

class ConfigController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('restoreDatabase','showUpdateProgress','progressBar','update','admin','changeLogo','emailSetup','about'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
/*DISABLED 
	public function actionCreate()
	{
		$model=new Config;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	*/
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/* DISABLD
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
*/
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Config');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	
	
	public function actionAdmin()
	{
	
		$this->render('admin');
	}

	
	public function actionChangeLogo()
	{
	   
	
	    if(isset($_POST['finish']))
		{
	        if (( ($_FILES["logo_url"]["type"] == "image/png")) && ($_FILES["logo_url"]["size"] < 1000000))
				{
//					echo "YEPPTY";
					if ($_FILES["logo_url"]["error"] > 0)
						{
							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
							}
					else
					{
//						echo "Upload: " . $_FILES["logo_url"]["name"] . "<br />";				
//						echo "Type: " . $_FILES["logo_url"]["type"] . "<br />";
//						echo "Size: " . ($_FILES["logo_url"]["size"] / 1024) . " Kb<br />";
//						echo "Temp uploaded: " . $_FILES["logo_url"]["tmp_name"] . "<br />";
//						$uploadedname="company_logo.png";
						
						$uploaded_file= $_FILES["logo_url"]["tmp_name"];
						$location="images/company_logo.png";
						//echo '<br>'.$location;
							if (move_uploaded_file($uploaded_file,$location))
							{
								echo "Stored";
							}
							else
								{
									echo "Not Stored: ";
								}
								
								
					}//end of else

				}///end of file upload if
				else
				{
				echo "Invalid FILE";
				}//end of else
	        

	    	}//end of isset post finish
	    $this->render('changeLogo');
	}///end of function chgange logo
	
	public function actionEmailSetup()
	{
	
		$this->render('admin');
	}

	public function actionAbout()
	{
	
		$this->render('about');
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Config::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionRestoreDatabase()
	{
	   
	    if(isset($_POST['finish']))
		{
//			echo 'DATA BASEFILE :  '. $_FILES["database"]["error"];
			
	        if ($_FILES["database"]["type"] == "application/octet-stream" && $_FILES["database"]["name"] == "chs.db")
				{
					if ($_FILES["database"]["error"] > 0)
						{
							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
						}//end of if for error
					else
					{
						echo 'YEPPY';
						
						$uploaded_file= $_FILES["database"]["tmp_name"];
						$location="protected/data/chs.db";
						//echo '<br>'.$location;
							if (move_uploaded_file($uploaded_file,$location))
							{
								echo "<span style='background-color:green; color:black;' > Database Restored </span><br>";
							}
							else
								{
									echo '<span style="background-color:red; color:black;">Not Stored , Please try again</span><br> ';		
								}
						
					}//end of else
				}///end of if for check for database file check
				else {
					echo '<span style="background-color:red; color:black;">Please upload chs.db file only</span><br> ';		
				}
				
				
			
		}//ennd of if of post finish
		
		$this->render('restoreDatabase');
		
//	        if (( ($_FILES["database"]["type"] == "application/octet-stream")) && ($_FILES["logo_url"]["size"] < 1000000))
//				{
////					echo "YEPPTY";
//					if ($_FILES["logo_url"]["error"] > 0)
//						{
//							echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
//							}
//					else
//					{
////						echo "Upload: " . $_FILES["logo_url"]["name"] . "<br />";				
////						echo "Type: " . $_FILES["logo_url"]["type"] . "<br />";
////						echo "Size: " . ($_FILES["logo_url"]["size"] / 1024) . " Kb<br />";
////						echo "Temp uploaded: " . $_FILES["logo_url"]["tmp_name"] . "<br />";
////						$uploadedname="company_logo.png";
//						
//						$uploaded_file= $_FILES["logo_url"]["tmp_name"];
//						$location="images/company_logo.png";
//						//echo '<br>'.$location;
//							if (move_uploaded_file($uploaded_file,$location))
//							{
//								echo "Stored";
//							}
//							else
//								{
//									echo "Not Stored: ";
//								}
//								
//								
//					}//end of else
//
//				}///end of file upload if
//				else
//				{
//				echo "Invalid FILE";
//				}//end of else
//	        
//
//	    	}//end of isset post finish
	    
	}///end of function Restore Database
	
	public function actionProgressbar()
	{
		//echo "hello";
		//$message="Hello";
		$this->widget('zii.widgets.jui.CJuiProgressBar', array(
					    'id'=>'progress',
					    'value'=>10,
					    'htmlOptions'=>array(
					        'style'=>'width:200px; height:15px; float:left; background-color:#44F44F ;background:#EFFDFF',
					        'color' => 'blue'
					    ),
					    ));
				
		 $this->render('about');
		 
	}//end of progressbar().
	
	
	
	
	public function actionDownloadZip()
	{
 
		$last_successful_step='';
		$last_successful_step_message='';
		$request='http://rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
		
		$installed_version=Yii::app()->params['software_version'];
		$available_version = file_get_contents($request, true);
				
		$filename = $installed_version."_to_".$available_version."_update.zip";
		$filepath = "http://www.rapportsoftware.co.uk/versions/";
		$fullpath=$filepath.$filename;
 		
		$from=$fullpath;
		$update_directory='updates';
		$to=$update_directory.'/'.$filename;
		
		
/*STEP 1*//*Downlaoding the update file*/
		if (!@copy($from,$to)) {
				$errors= error_get_last();
 			    echo "File Download ERROR: ".$errors['type']."<br>".$from;
 				echo "<br />\n".$errors['message'];
				echo "<br /><span style='color:red;'>There was some problem in downloading the file from the server. Please check your internet connection. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /></span> ";
		} else {
			$last_successful_step=1;
			$last_successful_step_message="Files succesfully downloaded!";
			echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
			echo "  : ".$last_successful_step_message.'</span>';
			
/*STEP 2*//*Creating a backup of database*/		
			/*Creating a backup of database*/
			$db_current_location=getcwd().'\protected\data\chs.db';
			$db_backup_location = $update_directory.'\backup\version_'.$installed_version.'_database';
			$db_backup_filename=$db_backup_location.'\ver_'.$installed_version.'.data.db';
			
			if( !file_exists($db_backup_filename) )
			{
			
				if(!is_dir($db_backup_location))
				{
					if (!mkdir($db_backup_location, 0, true)) {
						die('Failed to create folders...');
					}
				}
				
 			if (!@copy($db_current_location,$db_backup_filename)) {
			$errors= error_get_last();
			echo "<br>Database backup creation error: ".$errors['type'];
 			echo "<br />\n".$errors['message'];
			echo "<br /><span style='color:red;'>There was some problem in creating backup of database. Make sure all users are logged out of the system.  If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /></span> ";
			}///end of if of STEP 2 database backup error
				else {
						echo "";
						$last_successful_step=2;
						$last_successful_step_message="Database successfully Backuped";
						echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
						echo "  : ".$last_successful_step_message.'</span>';
					}


			}//////end of if of is backup file present .i.e. to check backup already created
				else
				{
						$last_successful_step=2;
						$last_successful_step_message="Database backup skipped because data is already backed up";
						echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
						echo "  : ".$last_successful_step_message.'</span>';
				}////end of else of database backup skipped



				if ($last_successful_step==2)
				{
/*STEP 3*//*Creating Backup of Files*/
					/*Creating Backup of Files*/
					$source=getcwd().'\protected';
					$dest=$update_directory.'\backup\version_'.$installed_version.'_files\protected';
					
					if(!is_dir($dest))
					{
						if (!mkdir($dest, 0, true)) {
							die('Failed to create folders...');
						}
					}
				
					if ($this->recurse_copy($source, $dest)==true)
					{
							$last_successful_step=3;
							$last_successful_step_message="Files have been successfully backed up";
							echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
							echo "  : ".$last_successful_step_message.'</span>';

/*STEP 4*//*Unzipping Downloaded files*/
					
							/*Unzipping Downloaded files*/
							if(!is_dir($update_directory))
							{
								if (!mkdir($update_directory, 0, true)) {
									die('Failed to create folders...');
								}
							}
							$zip = new ZipArchive;
							$res = $zip->open( $to);
							if ($res === TRUE) {
								$zip->extractTo($update_directory);
								$zip->close();

								$last_successful_step=4;
								$last_successful_step_message="Downloaded Files have been successfully unzipped";
								echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
								echo "  : ".$last_successful_step_message.'</span>';
								

/*STEP 5*//*Modifying the Database*/
							/*Modifying the Database*/			
								$unzip_folder = $update_directory.'/'.$installed_version."_to_".$available_version."_update";
								
								$setup_file=$unzip_folder.'/setup.json';/*THE SETUP FILES IS LIKE CONTENTS OF NEW FILES TO BE COPIED*/
								
								$json=file_get_contents($setup_file);
								$jsonIterator = new RecursiveIteratorIterator(
											new RecursiveArrayIterator(json_decode($json, TRUE)),
													RecursiveIteratorIterator::SELF_FIRST);	
								 
								
								
								$db_update_file='';
								foreach ($jsonIterator as $key => $val) {
										if ($key=='database')
										{
										$db_update_file=getcwd().'/'.$unzip_folder.$val;
										}	
								}///end of foreach iterator


								try
								{
									$db = new PDO('sqlite:protected\data\my.db');
									//	echo '<hr>'.$db_update_file;
									$file_handle=fopen($db_update_file,'r');
									echo "<br />";
									while(!feof($file_handle))
									{
										$line=fgets($file_handle);
										
										$db->exec($line);
										echo $line."<br>";
									/*
										$worked=$db->exec($line);
										
										if (!$worked) {
											@$db->exec('ROLLBACK');
											echo "\nPDO::errorInfo():\n";
											print_r($db->errorInfo());
											$error='';
											throw new Exception('Unable to create Code Coverage SQLite3 database: ' . $error);
											}
											
										*/
									}
									fclose($file_handle);
								// close the database connection
								$db = NULL;
								

								$last_successful_step=5;
								$last_successful_step_message="Database is successfully changed";
								echo "<hr><br /><span style='color:green;'>STEP-".$last_successful_step;
								echo "  : ".$last_successful_step_message.'<br></span>';
						
/*STEP 6*//*Moving updated Files*/
							/*Moving updated Files*/				

								$folder='';
								foreach ($jsonIterator as $key => $val) {
									if(is_array($val)) {
										echo "$key:<br>";
										if ($key=='folders')
										{
											$folder=true;
										}
										else{
											$folder=false;
										}/////end of if of folder check
									} ////end of if of is_array
										else {
											if ($folder)
												{
													echo "<hr><span style='color:green;'> $key => $val</span><br>";
													/*COPY FOLDERS NOW*/
													$folder_name=$key;
													$folder_copy_from=getcwd().'/'.$unzip_folder.''.$val;
													$folder_copy_to=getcwd().'/protected/'.$folder_name;
													
													echo " <span style='color:green;'>";
													echo "COPY FROM :".$folder_copy_from;
													echo "<br>COPY TO :".$folder_copy_to;
													echo "</span><hr>";
													
													
													if ($this->recurse_copy($folder_copy_from, $folder_copy_to)==false)
														{
															throw new Exception('Unable to copy folders.');
														
														}///end of if copy
														else
														{
														echo " <span style='color:green;'> COPIED</span><hr>";
														
														}
													

												}////end of if of copy folders
									}///end of else of is_array
								}///end of foreach iterator
								
								
								
								
								
								
								
								}
								catch(PDOException $e)
								{
									print 'Exception : '.$e->getMessage();
									}
												
								
								
								
								
								
								
								
								
								
								
							}///end of if of file unzipped
							else
							{
							
							$last_successful_step=4;
							$last_successful_step_message=" There was some problem in unzippping the downloaded files. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /> ";;
							echo "<hr><br /><span style='color:red;'> UNSUCCESSFUL STEP-".$last_successful_step;
							echo "  : ".$last_successful_step_message.'</span>';
							exit;
							
							}//end of else of file not unzippped
					
					
					
					
					
					
					
					
					
					}//end of if not recursive copy
					else
						{
							$last_successful_step=3;
							$last_successful_step_message=" There was some problem in creating mannual backup of files. Try again to run the backup. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /> ";;
							echo "<hr><br /><span style='color:red;'> UNSUCCESSFUL STEP-".$last_successful_step;
							echo "  : ".$last_successful_step_message.'</span>';
							exit;
						}///end of else of recursive copy
				}////end of if of step 3
				else
				{
					$last_successful_step=2;
					$last_successful_step_message="Database not backup was not performed so cannot proceed";
					echo "<hr><br /><span style='color:red;'> UNSUCCESSFUL STEP-".$last_successful_step;
					echo "  : ".$last_successful_step_message.'</span>';
 						exit;
				}///end of else of step 3


		}//////END OF ELSE OF STEP 1
		
		//$this->render('showUpdateStatus');
}///end of 	public function actionDownloadZip()
	
	

	public function recurse_copy($src,$dst) 
	{ 
   		 $dir = opendir($src); 
    		@mkdir($dst); 
   			 while(false !== ( $file = readdir($dir)) ) { 
       		 if (( $file != '.' ) && ( $file != '..' )) { 
	            if ( is_dir($src . '/' . $file) ) { 
	                $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	            else { 
						if (!copy($src . '/' . $file,$dst . '/' . $file))
							{
							echo 'Error in copying files';
							return false;
							exit;
							}
	            } //end of if else is_dir
       		 }///end of if $file 
    		}//////end of while 
    	closedir($dir); 
		return true;
	}//end of function   recurse_copy($src,$dst) { 
	
	
	/**
	 * Deletes a directory and all files and folders under it
	 * @return Null
	 * @param $dir String Directory Path
	 */
	public function rmdir_files($dir) 
	{
	 $dh = opendir($dir);
	 if ($dh) {
	  while($file = readdir($dh)) {
	   if (!in_array($file, array('.', '..'))) {
	    if (is_file($dir.$file)) {
	     unlink($dir.$file);
	    }
	    else if (is_dir($dir.$file)) {
	     rmdir_files($dir.$file);
	    }
	   }
	  }
	  rmdir($dir);
	 }
	}///end of function rmdir_files($dir) {

	public function actionShowUpdateProgress($curr_step)
	{
	    $model=new Config;
	    
	   //echo "step value in controller ".$curr_step; 
	    
	   $step=$curr_step;
	    
	        
	    if($step!=6)
	    {
	    	$currStep = $model->updateVersion($step);
	    }//end of if.
	    
	   
	    $this->render('showUpdateProgress',array('currStep'=>$currStep));
	}//end of showUpdateProgress().
	
		

}//end of class.

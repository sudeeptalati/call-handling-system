<?php  
$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('config/changeLogo')),
	array('label'=>'About & Help', 'url'=>array('config/about')),
	array('label'=>'Restore Database', 'url'=>array('config/restoreDatabase')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	
);


?>



<h4>Restore Database</h4>
Note:- This will delete the exisiting database and restore it with the database which you will upload. Advised to use this feature only in upadates 

 
<br>
<br>
<form id="install" action="restoreDatabase" enctype="multipart/form-data" method="post">		

		
		<small>Unzip the backup folder you want to upload and choose the file chs.db</small><br>
		<input type="file" name='database'/>
		
		<!-- 
  <input type="submit" name="finish" value="Restore" />
   -->
  <input onclick="if (!confirm('Are you sure you want to continue?')) return false;" name="finish" type="submit" value="Restore" />
 <br>
 </form>
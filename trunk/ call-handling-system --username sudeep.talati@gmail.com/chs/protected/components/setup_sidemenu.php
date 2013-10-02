<?php

$this->menu=array(
	array('label'=>'Tasks To Do', 'url'=>array('TasksToDo/admin')),
	array('label'=>'Company Details', 'url'=>array('/setup/view&id=1')),
	array('label'=>'Brands / Make', 'url'=>array('Brand/admin')),
	array('label'=>'Model Numbers / Make', 'url'=>array('Modelnumbers/admin')),
	
	array('label'=>'Contracts', 'url'=>array('Contract/admin')),
	array('label'=>'Company Logo', 'url'=>array('setup/changeLogo')),
	array('label'=>'Engineers', 'url'=>array('Engineer/admin')),

	array('label'=>'Internet', 'url'=>array('/advanceSettings/update&id=10001')),
	//array('label'=>'FTP Settings', 'url'=>array('ftpSettings/update/1')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	//array('label'=>'Mail Notifications', 'url'=>array('setup/mailServer')),
	array('label'=>'Notifications', 'url'=>array('/notificationRules/admin')),
	array('label'=>'Other Devices', 'url'=>array('setup/remoteConnection')),
	array('label'=>'Postcode Anywhere Account', 'url'=>array('setup/postcodeAnywhereView')),
	array('label'=>'Products / Product Type', 'url'=>array('ProductType/admin')),
	//array('label'=>'Preferences', 'url'=>array('/preferences/admin')),
	array('label'=>'Restore Database', 'url'=>array('setup/restoreDatabase')),
	//array('label'=>'SMS Notifications', 'url'=>array('setup/smsSettingsForm')),
	array('label'=>'Spares Cloud URL Setup', 'url'=>array('setup/cloudUrlUpdated')),
	array('label'=>'Users', 'url'=>array('User/admin')),
	array('label'=>'Countries', 'url'=>array('countryCodes/admin')),
	//array('label'=>'Advance Settings', 'url'=>array('/advanceSettings/admin')),
	array('label'=>'About & Help', 'url'=>array('setup/about')),
	
	
);
		
?>
 
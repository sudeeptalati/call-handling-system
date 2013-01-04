
 
<?php
$this->menu=array(
	array('label'=>'Contract Setup', 'url'=>array('Contract/admin')),
	array('label'=>'Engineer Setup', 'url'=>array('Engineer/admin')),
	array('label'=>'User Setup', 'url'=>array('User/admin')),
	array('label'=>'Brand Setup', 'url'=>array('Brand/admin')),
	array('label'=>'Product Setup', 'url'=>array('ProductType/admin')),
	array('label'=>'Notification Setup', 'url'=>array('/notificationRules/admin')),
	array('label'=>'Mail Settings', 'url'=>array('setup/mailServer')),
	array('label'=>'SMS Gateway Settings', 'url'=>array('setup/smsSettingsForm')),
	array('label'=>'Spares Cloud URL Setup', 'url'=>array('setup/cloudSetup')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	//array('label'=>'FTP Settings', 'url'=>array('sparesLookup/update/1')),
	array('label'=>'FTP Settings', 'url'=>array('ftpSettings/update/1')),
	array('label'=>'Change Logo', 'url'=>array('setup/changeLogo')),
	array('label'=>'Restore Database', 'url'=>array('setup/restoreDatabase')),
	array('label'=>'About & Help', 'url'=>array('setup/about')),
);
		
?>
 